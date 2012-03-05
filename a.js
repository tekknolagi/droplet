(function () {
	var filesUpload = document.getElementById("files-upload");
	var dropArea = document.getElementById("drop-area");

	function uploadFile (file, fileid) {
		ext = file.name.split('.').pop()
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4) {
				window["fn"+fileid] = xhr.responseText;
				if (window["fn"+fileid] != "fail")
				$("progress"+fileid).innerHTML = "<a href=\""+window["fn"+fileid]+"\" target=\"_blank\">"+file.name.substring(0, 30)+"...-."+ext+"</a>";
				else alert("failed to upload");
				}
		}
		var a = new Element("div");
		a.id = "progress"+fileid; a.setStyle("background-color", "#4682B4"); a.setStyle("height", "20px"); a.setStyle("width", "330px");
		$("progress-wrapper").adopt(a);
		xhr.upload.onprogress = function(e, a) {
			var percent = Math.round((e.loaded*150)/e.total); var acperct = Math.round(percent/1.5);
			$("progress"+fileid).innerHTML = file.name.substring(0,30)+"...-."+ext+" "+acperct+"%";
		}
		
		alpha = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNNOPQRSTUVWXYZ1234567890-_".split("");
		tmp_name = [];
		for (i = 0; i < 10; i++) tmp_name[i] = alpha[Math.floor(Math.random() * alpha.length)];
		xhr.open("POST", "upload.php", true);
		xhr.setRequestHeader("Content-Type", "multipart/form-data");
		xhr.setRequestHeader("name", file.name);
		xhr.setRequestHeader("tmp_name", tmp_name.join(""));
		xhr.send(file);
	}
	var x = 0;

	function traverseFiles (files) {
		if (typeof files !== "undefined") {
			for (var i = 0, l = files.length; i < l; x++, i++) {
				uploadFile(files[i], x);
			}
		}
		else {
			alert("No support for the File API in this web browser!");
		}
	}

	filesUpload.addEventListener("change", function () {
		traverseFiles(this.files);
		$("drop-area").setStyle('background-color', '#4682B4');
	}, false);

	dropArea.addEventListener("dragleave", function (event) {
		var target = event.target;
		if (target && target === dropArea)
			this.className = "";
		event.preventDefault();
		event.stopPropagation();
		$("drop-area").setStyle('background-color', 'lightblue');
	}, false);

	dropArea.addEventListener("dragenter", function (event) {
		this.className = "over";
		event.preventDefault();
		event.stopPropagation();
		$("drop-area").setStyle('background-color', '#4682B4');
	}, false);

	dropArea.addEventListener("dragover", function (event) {
		event.preventDefault();
		event.stopPropagation();
		$("drop-area").setStyle('background-color', '#4682B4');
	}, false);

	dropArea.addEventListener("drop", function (event) {
		traverseFiles(event.dataTransfer.files);
		this.className = "";
		event.preventDefault();
		event.stopPropagation();
		$("drop-area").setStyle('background-color', 'lightblue');
	}, false);
})();
