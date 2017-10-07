<?php
	include_once("simple_html_dom.php");
	$url = "http://music.baidu.com/search?key=";
	$musicName = $_GET["q"];

	$html = file_get_html($url.$musicName);//simple_html_dom
	//echo $html;
	//echo $html;
	//var_dump($html);
	$elements = $html->find("li.song-item-hook div.song-item");//simple_html_dom_node
	//var_dump($elements);
	
	$array_song = array();
	$index = 0;
	$strContent = '<table class="table table-striped">
                    <thead>
                      <tr>
                        <th>编号</th>
                        <th>歌名</th>
                        <th>歌手/专辑</th>
                        <th>下载</th>
                      </tr>
                    </thead>
                    <tbody>';
	
                    
                    //var_dump()
		for($i = 0 ; $i < count($elements); $i++){
	
		$elementTitle = $elements[$i]->children(4);
		$elementSinger = $elements[$i]->children(5);
		//var_dump($elementTwos);
		$elementNoloose = $elements[$i]->children(7)->children(0);
		//var_dump($elementNoloose);
		//var_dump($elementNoloose->title);
		if($elementNoloose->title == "无损资源"){
			
			$songHref = $elementTitle->children(0);
			$songTitle =$songHref->plaintext;
			$songSinger = $elementSinger->children(0)->title;
			
			//var_dump($songHref->href);
			
			$arrayStr =explode("/",$songHref->href);
			$sondId = $arrayStr[2];
			
			//echo $songTitle.'<br />';
			$requestUrl = "http://music.baidu.com/data/music/songlink?songIds="
												. $sondId
												. "&hq=&type=flac&rate=&pt=0&flag=-1&s2p=-1&prerate=-1&bwt=-1&dur=-1&bat=-1&bp=-1&pos=-1&auto=-1";
												$json = file_get_html($requestUrl);
												//echo $json;
			$arrayJson = json_decode($json);
			$dataJson = $arrayJson->data;
			//var_dump( $dataJson);
			$jsonArray = $dataJson->songList;
			//var_dump( $jsonArray);
			$jsonSong = $jsonArray[0];
			//var_dump($jsonSong);
			$songLink = $jsonSong->showLink;
			//echo $songLink;
			//$array_song[$index] = $songLink;
			if ( $index % 5 == 0 )
                    	{
                    		$strContent .= '<tr >
                        <td>'.$index.'</td>
                        <td>'.$songTitle.'</td>
                        <td>'.$songSinger.'</td>
                        <td><button id="bt2" class="btn btn-success btn-large"><a class="dl" download='.$songTitle.' href='.$songLink.' style="color: #fff;">下载</a></button></td>
                       </tr>';
                    	}
                    	elseif($index % 5 == 1)
                    	{
                    		$strContent .=  '<tr class="success">
                        <td>'.$index.'</td>
                        <td>'.$songTitle.'</td>
                        <td>'.$songSinger.'</td>
                        <td><button id="bt2" class="btn btn-success btn-large"><a class="dl" download='.$songTitle.' href='.$songLink.' style="color: #fff;">下载</a></button></td></tr>';
                    	}
                    	elseif ( $index % 5 == 2 )
                    	{
                    		$strContent .= '<tr class="error">
                        <td>'.$index.'</td>
                        <td>'.$songTitle.'</td>
                        <td>'.$songSinger.'</td>
                       <td><button id="bt2" class="btn btn-success btn-large"><a class="dl" download='.$songTitle.' href='.$songLink.' style="color: #fff;text-decoration:none;">下载</a></button></td> </tr>';
                    	}
                    	elseif ( $index % 5 == 3 )
                    	{
                    		$strContent .=  '<tr class="warning">
                        <td>'.$index.'</td>
                        <td>'.$songTitle.'</td>
                        <td>'.$songSinger.'</td>
                        <td><button id="bt2" class="btn btn-success btn-large"><a class="dl" download='.$songTitle.' href='.$songLink.' style="color: #fff;">下载</a></button></td></tr>';
                    	}
                    	elseif ( $index % 5 == 4 )
                    	{
                    		$strContent .=  '<tr class="info">
                        <td>'.$index.'</td>
                        <td>'.$songTitle.'</td>
                        <td>'.$songSinger.'</td>
                        <td><button id="bt2" class="btn btn-success btn-large"><a class="dl" download='.$songTitle.' href='.$songLink.' style="color: #fff;">下载</a></button></td> </tr>';
                    	}
			$index++;
			

			
		}
		
		
	}
	$strContent .='</tbody></table>';
		
	echo $strContent;
	



?>