Adapter (Адаптер). Унифицирует классы и объекты.
Используется для преобразования одного интерфейса
в другой, необходимый клиенту.

<img src="/img/34.png">

interface MediaPlayer{
	function play($type, $name);
}
interface SuperMediaPlayer{
	function playOgg($name);
	function playMp4($name);
}

class OggPlayer implements SuperMediaPlayer{
	function playOgg($name){
		echo "Playng OGG $name" . PHP_EOL;
	}
	function playMp4($name){}
}

class Mp4Player implements SuperMediaPlayer{
	function playOgg($name){}
	function playMp4($name){
		echo "Playng MP4 $name" . PHP_EOL;
	}
}

class MediaAdapter implements MediaPlayer{
	private $superMediaPlayer;
	function __construct($type){
		switch($type){
			case "OGG": $this->superMediaPlayer = new OggPlayer();
				break;
			case "MP4": $this->superMediaPlayer = new Mp4Player();
				break;
		}
	}
	function play($type, $name){
		switch($type){
			case "OGG": $this->superMediaPlayer->playOgg($name);
				break;
			case "MP4": $this->superMediaPlayer->playMp4($name);
				break;
		}
	}
}

class AudioPlayer implements MediaPlayer{
	private $mediaAdapter;
	function play($type, $name){
		switch($type){
			case "WAV": echo "Playng WAV $name" . PHP_EOL;
				break;
			case "MP3": echo "Playng MP3 $name" . PHP_EOL;
				break;
			case "OGG":
			case "MP4":
				$this->mediaAdapter = new MediaAdapter($type);
				$this->mediaAdapter->play($type, $name);
		}
	}
}

$p = new AudioPlayer;
$p->play("WAV", "Song1");
$p->play("MP3", "Song2");
$p->play("OGG", "Song3");
$p->play("WAV", "Song4");

////////
Получаем
Playng WAV Song1
Playng MP3 Song2
Playng OGG Song3
Playng WAV Song4
