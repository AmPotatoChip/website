	$(document).ready(function(){
		$(document).ready(function() {
			$("#fileuploader").uploadFile({
				url:"upload.php",
				multiple:false,
				dragDrop:false,
				maxFileCount:1,
				formData: $("#orderFrm").serialize(),
				fileName:"myfile"
			});
		});
	});
