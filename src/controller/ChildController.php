<?php

namespace App\src\controller;

use App\config\Parameter;
use App\src\model\Child;

class ChildController extends Controller
{
	public function listChildren()
	{
		if ($this->checkLoggedIn()) {
			$childrenArray = $this->childDAO->listChildren();
			$children = [];
			foreach ($childrenArray as $childArray) {
				$child = new Child($childArray);
				$children[] = $child;
			}
			return $this->view->render('home', [
				'children' => $children
			]);
		}
	}

	public function addChild(Parameter $post)
	{
		if ($this->checkLoggedIn()) {
			if ($post->get('submit')) {
				$this->childDAO->addChild($post);
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

			$childArray['attendance'] = $this->attendanceDAO->getAttendanceChild($childId);

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
			if ($childId && $post->get('submit')) {
				$affectedLines = $this->attendanceDAO->manageAttendance($childId, date('Y-m-d'), $post->get('attendanceAmount'));
				if ($affectedLines) {
					echo "Success";
					exit;
				} else {
					echo "Failed";
					exit;
				}
			}
			$childrenArray = $this->childDAO->listChildren();
			$children = [];
			foreach ($childrenArray as $childArray) {
				$child = new Child($childArray);
				$children[] = $child;
			}
			return $this->view->render('attendance', [
				'children' => $children
			]);
		}
	}
}
