<?php
class Index extends AController{
	public function getBody(){
		$posts = new Posts;
		$text = $posts->getAllDb();
		return $this->render('index', ['title'=>'Index Page', 'text'=>$text]);
	}
}