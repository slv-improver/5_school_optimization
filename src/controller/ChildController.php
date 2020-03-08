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
		if ($post->get('submit')) {
			$this->childDAO->addChild($post);
			$this->session->set('add_child', 'Le nouvel enfant a bien été ajouté');
			header('Location: index.php?route=listChildren');
			exit;
		}
		return $this->view->render('register');
	}
	
	public function deleteChild($childId)
	{
		$this->childDAO->deleteChild($childId);
		$this->session->set('delete_child', 'L\'enfant a bien été supprimé');
		header('Location: index.php?route=listChildren');
		exit;
	}
}
