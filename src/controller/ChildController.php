<?php

namespace App\src\controller;

use App\config\Parameter;

class ChildController extends Controller
{
	public function listChildren()
	{
		if ($this->checkLoggedIn()) {
			$children = $this->childDAO->listChildren();
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
		header('Location: index.php?route=listChildren');
		exit;
	}
}
