<?php
class View extends AController{
	public function getBody(){
		if (isset($_GET['id'])) {
			$id = (int)$_GET['id'];
			$posts = new Posts;
			$text = $posts->getOneDb($id);
			return $this->render('view', ['title'=>'Index Page', 'text'=>$text]);
		}
		else{
			exit('Wrong Parameter!');
		}
	}
}