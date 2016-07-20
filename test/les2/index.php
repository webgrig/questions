<?php
class Page{
	public $title;
	public $content;
	public $footer;

	public function __construct($t, $c, $f){
		$this->title = $t;
		$this->content = $c;
		$this->footer = $f;
	}

	public function renderBody(){
		$str = '<h1>' . $this->title . '</h1>';
		$str .= '<p>' . $this->content . '</p>';
		$str .= '<p style="font-size:8px;">' . $this->footer . '</p>';

		return $str;
	}
}

class Index extends Page{
	public $slide;
	public $news;

	public function __construct($t, $c, $f){
		parent::__construct($t, $c, $f);
	}

	public function renderBody(){
		$str = parent::renderBody();
		$str .= '<p>' . $this->slide . '</p>';
		$str .= '<p>' . $this->news . '</p>';

		return $str;
	}
}

$page = new Page('Page', 'Hello I m page', 'footer');
echo $page->renderBody();

$index = new Index('Index', 'Hello I m index', 'footer');
$index->slide = 'slide show';
$index->news = 'news';
echo $index->renderBody();