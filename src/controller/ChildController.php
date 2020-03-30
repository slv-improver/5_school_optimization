<?php

namespace App\src\controller;

use App\config\Parameter;
use App\src\model\Child;

class ChildController extends Controller
{	
	/**
	 * listChildren
	 *
	 * @param  mixed $currentPage ($_GET['p'])
	 * @return View [children list, number of pages]
	 */
	public function listChildren($currentPage)
	{
		if ($this->checkLoggedIn()) {
			$childCount = $this->childDAO->countChildren();
			$perPage = 10;
			$pageCount = ceil($childCount / $perPage);
			if (!isset($currentPage) || !is_numeric($currentPage) || $currentPage > $pageCount) {
				$currentPage = 1;
			}
			$childrenArray = $this->childDAO->listChildren(($currentPage - 1) * $perPage, $perPage);
			$children = [];
			foreach ($childrenArray as $childArray) {
				// add attendance key to childArray
				$childArray['attendance'] = $this->attendanceDAO->getAttendanceChild($childArray['id']);
				$child = new Child($childArray);
				$children[] = $child;
			}
			return $this->view->render('home', [
				'children' => $children,
				'numberOfPages' => $pageCount,
				'currentPage' => $currentPage
			]);
		}
	}

	public function addChild(Parameter $post)
	{
		if ($this->checkLoggedIn()) {
			if ($post->get('submit')) {
				// $this->responsableDAO->checkResponsable($post, 'father');
				if (!empty($post->get('f_last_name'))) {
					$fatherId = $this->responsableDAO->addFather($post);
				}
				if (!empty($post->get('m_last_name'))) {
					$motherId = $this->responsableDAO->addMother($post);
				}
				$this->childDAO->addChild($post, $fatherId, $motherId);
				$this->session->set('add_child', 'Le nouvel enfant a bien été ajouté');
				header('Location: index.php?route=listChildren');
				exit;
			}
			return $this->view->render('register');
		}
	}

	public function deleteChild($childId)
	{
		if ($this->checkLoggedIn()) {
			$this->childDAO->deleteChild($childId);
			$this->session->set('delete_child', 'L\'enfant a bien été supprimé');
			header('Location: index.php?route=listChildren');
			exit;
		}
	}
	/**
	 * childCard display child information
	 *
	 * @param  mixed $childId
	 * @return ChildObject $child
	 */
	public function childCard($childId)
	{
		if ($this->checkLoggedIn()) {
			$childArray = [];
			$childArray = $this->childDAO->childCard($childId);

			$parents = $this->responsableDAO->getparents($childId);
			foreach ($parents as $parent) {
				if ($parent['rank'] === 'father') {
					$childArray['father'] = $parent;
				}
				if ($parent['rank'] === 'mother') {
					$childArray['mother'] = $parent;
				}
			}

			// add attendance key to childArray
			$childArray['attendance'] = $this->attendanceDAO->getAttendanceChild($childArray['id']);
			$childArray['documents'] = $this->childDAO->getDocuments($childArray['id']);
			
			$child = new Child($childArray);
			return $this->view->render('card', [
				'child' => $child
			]);
		}
	}

	/**
	 * manageAttendance save child attendance
	 *
	 * @param  int $childId
	 * @param  Parameter $post
	 * @return View|string
	 */
	public function manageAttendance($childId, Parameter $post)
	{
		if ($this->checkLoggedIn()) {
			$date = date('Y-m-d');
			if ($childId && $post->get('submit')) {
				$affectedLines = $this->attendanceDAO->manageAttendance($childId, $date, $post->get('attendanceAmount'));
				if ($affectedLines) {
					echo "Success";
					exit;
				} else {
					echo "Failed";
					exit;
				}
			}
			$childrenArray = $this->childDAO->listChildren(0);
			$children = [];
			$childrenHaveAttendance = [];
			foreach ($childrenArray as $childArray) {
				// add attendance key to childArray
				$childArray['attendance'] = $this->attendanceDAO->getAttendanceChild($childArray['id']);
				$child = new Child($childArray);
				if (array_key_exists($date, $child->getAttendance()->getTable())) {
					$childrenHaveAttendance[] = $child;
				} else {
					$children[] = $child;
				}
			}
			return $this->view->render('attendance', [
				'children' => $children,
				'childrenHaveAttendance' => $childrenHaveAttendance
			]);
		}
	}

	/**
	 * addDocument save child document
	 *
	 * @param  int $childId
	 * @param  Parameter $post
	 * @param  array $files
	 */
	public function addDocument($childId, Parameter $post, $files)
	{
		if ($this->checkLoggedIn()) {
			if ($childId && $post->get('submit')) {
				// file uploading
				if (isset($files['document']) && $files['document']['error'] == 0) {
					$file = $files['document'];
					if ($file['size'] <= 1000000) {
						$fileInfo = pathinfo($file['name']);
						$extension_upload = $fileInfo['extension'];
						if (in_array($extension_upload, ['jpg', 'jpeg', 'png', 'pdf'])) {
							$title = $post->get('title');
							$fileName = $title . '_' . round(microtime(true) * 1000) . '.' . $extension_upload;
							move_uploaded_file($file['tmp_name'], 'uploads/' . $fileName);
							echo "L'envoi a bien été effectué !";
						} else {
							echo "Le fichier n'est pas accépté. \n
							Verifiez l'extension";
						}
					} else {
						echo "Le fichier est trop volumineux";
					}
				} else {
					echo "Une erreur s'est produite lors de l'ajout du document";
				}

				// insert in db
				$affectedLines = $this->childDAO->addDocument($fileName, $title, $childId);
				if ($affectedLines) {
					header("Location: index.php?route=childCard&childId=$childId");
				} 
			}
		}
	}
}
