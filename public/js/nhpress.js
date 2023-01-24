$(document).ready(function()
{
	var editInProgress = false;
	var theTextAreaId;
	var theWordageId;
	var wordageEditMode = false;
	var wordageReload = false;
	var experienceEditMode = false;
	var experienceReload = false;
/*
	window_info = ({ "width" : $(window).width(), "height" : $(window).height()});
	var width = $(document).width();
	var height = $(document).height();
	var windowSizeText = "width: " + str(width) + " height: " + str(height);
	$("#sizetext") = windowSizeText;
	$("#floats").hide();
	$("#dialog").hide();
*/
/*
	$.ajax({
		type:"POST",
		data:window_info,
		url:"index/setsize",
		success:function(data) {
			//alert(data);
		}
	});
*/
	showMenu = function()
	{
	//	$("#main-bar").show();
	},
	showFileSub = function()
	{
		//alert("Hello");
		$("#file_sub").show();
	},
	closeForm = function()
	{
	    $("#dialog_box").hide();
	    $('#content').css("opacity", "1");
	},
	closeBox = function()
	{
	    $("#dialog_box").hide();
	    $('#content').css("opacity", "1");
	},
	loadWordageForm = function(wordagetextid,thetarget,thesource)
	{
		theWordageId = wordagetextid;
		thesource = "#" + thesource;
		alert(wordagetextid);
		$(thesource).hide();
		$.ajax({
			type:"POST",
			url:"/wordage/json/" + wordagetextid,
			theWordageID:wordagetextid,
			success: function(data) {
				var objJSON = JSON.parse(data);
				var theId = "#wordage-item-content";
				var theWordageText = objJSON.view;
				thetarget = "#" + thetarget;
				$(thetarget).show();
				$(thetarget).html(theWordageText);
			}
		});
	},
	editWordage = function(wordagetextid)
	{
		theWordageId = wordagetextid;
		$.ajax({
			type:"POST",
			url:"/wordage/json?id=" + wordagetextid,
			theWordageID:wordagetextid,
			success: function(data) {
				var objJSON = JSON.parse(data);
				var theId = "#wordage";
				var theWordageText = objJSON.view;
				theTextAreaId = theId
				theTarget = "#wordage-target-" + theId
				$(theTarget).show();
				$(theTarget).html(theWordageText);
 				tinymce.init({
            				'selector': '#wordage-edit-textarea',
            				'plugins' : 'insertdatetime,link,image',
            				'theme' : 'modern',
            				'theme__layout_manager' : 'SimpleLayout',
            				'theme__buttons1' : 'backcolor, forecolor, |, bold, underline, strikethrough, |, numlist, bullist, charmap, |, undo, redo, |, anchor, link, tvlink, unlink',
            				'theme__buttons2' : '',
            				'theme__buttons3' : ''
        			});
			}
		});
	},
	clickSignUp = function()
        {
		$.ajax({
			type:"POST",
			url:"auth/signup",
			success: function(data) {
				$("#dialog_box").html(data);
			}
		});
		$('#content').css("opacity", "0.5");
		$("#dialog_box").show();
	},
	clickLogin = function()
	{
		$.ajax({
			type:"POST",
			url:"auth/login",
			success: function(data) {
				$("#dialog_box").html(data);
			}
		});
		$('#content').css("opacity", "0.5");
		$("#dialog_box").show();
	},
	loadEditForm = function(topic,id)
	{
		if (topic == "wordage")
		{
		    $("#wordage-view").hide();
		    $("#wordage-edit").show();
		    $("#topic-toolbar-edit").hide();
		    $("#topic-toolbar-save").show();
		    $wordageEditMode = true;
		}
		else if (topic == "experience")
		{
		    $("#experience-view").hide();
		    $("#experience-edit").show();
		    $("#topic-toolbar-edit").hide();
		    $("#topic-toolbar-save").show();
		}
		else if (topic == "outline")
		{
		    $("#outline-view").hide();
		    $("#outline-edit").show();
		    $("#topic-toolbar-edit").hide();
		    $("#topic-toolbar-save").show();
		    $(".outline_tools").show();
		    $(".outline_tools").css("visibility","visible");
		}
	},
	loadViewForm = function(topic,id)
	{
			$("#topic-toolbar-save").show();		
			saveEditForm(id);
			//alert("load");
			var ed = tinyMCE.get('wordage-edit-textarea');
			//$ed.setProgressState(1); // Show progress
			var url = "/wordage/content/" + id;
			$.ajax({
			type:"POST",
			url:url,
			success: function(data) {
				ed.setContent(data.content);
				$("#wordage-view").innerHTML = data.content;
				}
			});			
			$wordageReload = false;
	},
	saveEditForm = function(topic,id)
	{
		$("#topic-toolbar-save").hide();		
		$("#topic-toolbar-edit").show();		
		if (topic == "wordage")
		{
			var theId = "wordage-edit-textarea";
			var ed = tinyMCE.get(theId);
			var content = ed.getContent();
			var url = "/wordage/change/" + id;
			$.ajax({
			type:"POST",
			url:url,
			data: 
			{
				thetext:content
			}, 
			success: function(data) {
				ed.setContent(data.content);
				$("#wordage-view").innerHTML = data.content;
			}
			});
		    	$("#wordage-view").show();
		    	$("#wordage-edit").hide();
		}
		else if (topic == "experience")
		{
			var description=$("input[type=text][name=description]").val();
			var skills=$("input[type=text][name=skills]").val();
			var role=$("input[type=text][name=role]").val();
			var company=$("input[type=text][name=company]").val();
			var title=$("input[type=text][name=title]").val();
			var startDate=$("input[type=text][name=startDate]").val();
			var endDate=$("input[type=text][name=endDate]").val();
/*
		     alert(description);
		     alert(skills);
		     alert(company);
		     alert(role);
		     alert(title);
		     alert(startDate);
		     alert(endDate);
*/
		    var url = "/experience/change/" + id;
			$.ajax({
			type:"GET",
			url:url,
			data: 
		    {
				description:description,
				skills:skills,
				company:company,
				role:role,
				title:title,
				startDate:startDate,
				endDate:endDate
		    }, 
		    success: function(data) {
				$("#wordage-view").innerHTML = data.content;
		    }
		    });
		    $("#experience-edit").hide();
		    $("#description-view").html(description);
		    $("#skills-view").html(skills);
		    $("#role-view").html(role);
		    $("#company-view").html(company);
		    $("#title-view").html(title);
		    $("#startDate-view").html(startDate);
		    $("#endDate-view").html(endDate);
		    $("#experience-view").show();
		}
	},
	deleteOutlineEntry = function(id,key)
	{
	    if (editInProgress == false)
	    {
		alert(id);
		alert(key);
		theOutlineId = id;
		theEntryKey = key;
		$.ajax({
			type:"POST",
			url:"/outline/delete",
			data: 
			{
				id:theOutlineId,
				key:theEntryKey,
			}, 
			success: function(data) {
					alert(data);
        			}
		});
	   }
	},
	addOutlineEntry = function(id,key)
	{
	    if (editInProgress == false)
	    {
		alert(id);
		alert(key);
		theOutlineId = id;
		theEntryKey = key;
		$.ajax({
			type:"POST",
			url:"/outline/add",
			data: 
			{
				id:theOutlineId,
				key:theEntryKey,
			}, 
			success: function(data) {
					alert(data);
        			}
		});
           }
	},
	saveOutlineEntry = function(id,key)
	{
		alert(id);
		alert(key);
		theOutlineId = id;
		theEntryKey = key;
		$.ajax({
			type:"POST",
			url:"/outline/save",
			data: 
			{
				id:theOutlineId,
				key:theEntryKey,
			}, 
			success: function(data) {
					alert(data);
        			}
		});
	},
	indentOutlineEntry = function(id,key)
	{
		alert(id);
		alert(key);
		theOutlineId = id;
		theEntryKey = key;
		$.ajax({
			type:"POST",
			url:"/outline/indent",
			data: 
			{
				id:theOutlineId,
				key:theEntryKey,
			}, 
			success: function(data) {
					alert(data);
        			}
		});
	},
	outdentOutlineEntry = function(id,key)
	{
		alert(id);
		alert(key);
		theOutlineId = id;
		theEntryKey = key;
		$.ajax({
			type:"POST",
			url:"/outline/outdent",
			data: 
			{
				id:theOutlineId,
				key:theEntryKey,
			}, 
			success: function(data) {
					alert(data);
        			}
		});
	},
	upOutlineEntry = function(id,key)
	{	
	    if (editInProgress == false)
	    {
		alert(id);
		alert(key);
		theOutlineId = id;
		theEntryKey = key;
		$.ajax({
			type:"POST",
			url:"/outline/up",
			data: 
			{
				id:theOutlineId,
				key:theEntryKey,
			}, 
			success: function(data) {
					alert(data);
        			}
		});
	    }
	},
	downOutlineEntry = function(id,key)
	{
	    if (editInProgress == false)
	    {
		alert(id);
		alert(key);
		theOutlineId = id;
		theEntryKey = key;
		$.ajax({
			type:"POST",
			url:"/outline/down",
			data: 
			{
				id:theOutlineId,
				key:theEntryKey,
			}, 
			success: function(data) {
					alert(data);
        			}
		});
	    }
	},
	editOutlineEntry = function(id,key)
	{
		viewIdDescription = "#outline-entry-view-"+id+"-"+key+"-description";
		editIdDescription = "#outline-entry-edit-"+id+"-"+key+"-description";
		viewIdTitle = "#outline-entry-view-"+id+"-"+key+"-title";
		editIdTitle = "#outline-entry-edit-"+id+"-"+key+"-title";
		editCmdTitle = "#outline-entry-button-"+id+"-"+key+"-edit";
		addCmdTitle = "#outline-entry-button-"+id+"-"+key+"-add";
		upCmdTitle = "#outline-entry-button-"+id+"-"+key+"-up";
		downCmdTitle = "#outline-entry-button-"+id+"-"+key+"-down";
		deleteCmdTitle = "#outline-entry-button-"+id+"-"+key+"-delete";
		if (editInProgress == false)
		{
			//$(viewIdDescription).css("visibility","hidden");
			$(editIdDescription).css("visibility","visible");
			//$(viewIdTitle).css("visibility","hidden");
			$(editIdTitle).css("visibility","visible");
			$(editCmdTitle).html("Save");
			$(editCmdTitle).css("color","red");
			$(addCmdTitle).css("color","grey");
			$(upCmdTitle).css("color","grey");
			$(downCmdTitle).css("color","grey");
			$(deleteCmdTitle).css("color","grey");
			editInProgress = true;
		}
		else 
		{
		   // Save the edits
		    theOutlineId = id;
		    theEntryKey = key;
		    theTitle = $(editIdTitle).val();
		    theDescription = $(editIdDescription).val();
		    //alert(theOutlineId);
		    //alert(theEntryKey);
		    //alert(theTitle);
		    //alert(theDescription);
		    $.ajax({
			type:"POST",
			url:"/outline/save",
			data: 
			{
				id:theOutlineId,
				key:theEntryKey,
				title:theTitle,
				description:theDescription
			}, 
			success: function(data) {
					alert(data);
        		}
		    });
		    editInProgress = false;
		    $(editCmdTitle).html("Edit");
		    $(editCmdTitle).css("color","black");
		    $(addCmdTitle).css("color","black");
		    $(upCmdTitle).css("color","black");
		    $(downCmdTitle).css("color","black");
		    $(deleteCmdTitle).css("color","black");
		}
	},
	clickLogout = function()
        {
                $.ajax({
			type:"POST",
			url:"auth/logout",
			success: function(data) {
			     $("#logout").html(data);
			     window.setTimeout(function() {window.location = "http://evtechnote.us/"}, 300)
			}
		});
	},
	wordageChangeFunc = function()
	{
		$.ajax({
			type:"POST",
			data: 
				{
				'id':theWordageId,
				'thetext': $("#wordage-edit-textarea").val()
			}, 
			url:"/wordage/change",
			success: function(data) {
				//alert(data);
			}
		});
	},
	clickPictureItem = function(pictureitemid)
        {
	   thePictureId = pictureitemid;
	   $.ajax({
		type:"POST",
		url:"/picture/edit?id=" + pictureitemid,
		success: function(data) {
			var objJSON = JSON.parse(data);
			var thePictureText = objJSON.view	
			$("#content-inner").show();
			$("#content-inner").html(thePictureText);
			darkr();
		}
	    });
	},
	clickDeleteWordage = function(wordagetextid)
	{
		var strconfirm = confirm("Are you sure you want to delete?");
		if (strconfirm == false)
		{
			return true;
		}
		theWordageId = wordagetextid;
		$.ajax({
			type:"POST",
			url:"/wordage/delete?id=" + wordagetextid,
			success: function(data) {
				window.location.href="/correspondant/index";
			}
		});
	},
	clickDeletePicture = function(picturetextid)
	{
		var strconfirm = confirm("Are you sure you want to delete?");
		if (strconfirm == false)
		{
			return true;
		}
		thePictureId = picturetextid;
		$.ajax({
			type:"POST",
			url:"/picture/delete?id=" + picturetextid,
			success: function(data) {
				window.location.href="/correspondant/index";
			}
		});
	},
	closeWordageEdit = function(wordagetextid)
	{
		//alert("close Wordage Edit");
		var newContent = tinymce.activeEditor.getContent();
		//alert(newContent);
		theWordageId = wordagetextid;
		$.ajax({
			type:"POST",
			url:"/wordage/update?id=" + wordagetextid,
			data:newContent,
			theWordageID:wordagetextid,
			success: function(data) {
				//alert("update ran");
				window.location.href="/correspondant/index";
				//window.location.href="http://dev.newhollandpress.com/correspondant/index";
			}
		});
	},
	upBinder = function(binder,maxBinder)
        {
		if (binder == maxBinder)
		{
			binder = 1;
		}
		else
		{
			binder += 1;
		}
		theBinderId = binder;
		theBinderId += 1;
		url = "/correspondant/index?binder=" + binder;
		window.location.href=url;
        }
	downBinder = function(binder,maxBinder)
        {
		if (binder == 1)
		{
			binder = maxBinder;
		}
		else
		{
			binder -= 1;
		}
		url = "/correspondant/index?binder=" + binder;
		window.location.href=url;
        }
	closeEditWordage = function()
        {
	    $("#dialog").show();
	    var dlg = $('#dialog').dialog({
           	modal: false,
            	draggable: false,
            	position: 'center',
            	zIndex: 99999,  // Above the overlay
            	width: 370,
            	title: 'Content Block Editor',
            	closeText: '',
            	open: function () {
               		$('body').css('overflow', 'hidden');
                	if ($.browser.msie) { $('html').css('overflow', 'hidden'); } $('<div>').attr('id', 'loader').appendTo('body').show();
            	},
            	close: function () { $('body').css('overflow', 'auto'); if ($.browser.msie) { $('html').css('overflow', 'auto'); } $('#loader').remove(); },
            	buttons: {
               		'Save': function () {
                    		tinyMCE.getInstanceById(theWordageText).remove();
                    		$('.EditLink').show();
                    		$(this).dialog('close');
                	},
                	'Cancel': function () {
                    		tinyMCE.getInstanceById(theWordageText).remove();
                    		$('.EditLink').show();
                    		$(this).dialog('close');
                	}
		}
            	}).parent();
        }
darkr = function()
{
          		var dkrm = new Darkroom('#target', {
            			minWidth: 100,
            			minHeight: 100,
            			maxWidth: 600,
            			maxHeight: 500,
            			ratio: 4/3,
            			backgroundColor: '#000',
            			// Plugins options
            			plugins: {
              			//save: false,
              				crop: {
                  				quickCropKey: 67, //key "c"
                  				//minHeight: 50,
                  				//minWidth: 50,
                  				//ratio: 4/3
                			}
              			},
            			// Post initialize script
            			initialize: function() {
              				var cropPlugin = this.plugins['crop'];
              				// cropPlugin.selectZone(170, 25, 300, 300);
              				cropPlugin.requireFocus();
              			}
          		});
	}
})
