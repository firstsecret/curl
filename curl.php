<?php
	//初始化
	$ch = curl_init();
	$url = "http://www.confluence.cn/pages/viewpage.action?pageId=6722677";
	$post = [];
	//设置变量
	curl_setopt($ch, CURLOPT_URL, $url);
	// 禁用后cURL将终止从服务端进行验证
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	//关闭证书检测
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	//关闭头文件的信息作为数据流输出
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	//是否是post请求判断
	if(!empty($data))
	{
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}
	//将curl_exec获取的信息以文件流的形式返回，而不是直接输出 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	//执行
	$data = curl_exec($ch);
	//获取内容中网站的请求
	// $res = preg_match_all('/<a[^>]+?href=[\"\']?([^\"\']+)[\"\']?[^>]*>([^<]+)<\/a>/i',$data,$match_res);
	$res = preg_match_all('/hrefs*=s*(?:\"([^\"]*)\"|\'([^\']*)\'|([^\"\'>s]+))/i',$data,$match_res);
	echo '<pre>';
	var_dump($match_res);
	//获取图片的src
	$res_img = preg_match_all('/<img.*?src=[\"|\']?(.*?)[\"|\']?\s.*?>/i',$data,$match_res);
	echo '图片的src';
	var_dump($match_res[1]);
	curl_close($ch);
	// echo $data;	
	//将网页内容存储起来
	$file = './curl_content.html';
	file_put_contents($file, $data);
