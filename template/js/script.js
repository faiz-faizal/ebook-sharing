$(document).ready(function(){

   $('.overlay').hide();
   $('.sk-circle').hide();

  //fade in body content
  $('.container,.wrapper').hide().fadeIn(1000);

   // Remove active for all items.
  $('.navbar-nav li').removeClass('active');

  // highlight submenu item
  var locations = this.location.pathname;
  
  var newloc = "." + locations.substring(9);

  $('li a[href="' + newloc + '"]').parent().addClass('active');
  if(locations == "/elibrary/index.php" 
    || locations == "/elibrary/" || 
    locations == "/elibrary")
  {
    $('li a[href="./index.php"]').parent().addClass('active');
  }

  /*USE THIS INSTEAD OF ABOVE CODE IF THE FILES IS HOSTED IN THE ROOT DIRECTORY
  var newloc = "." + locations;

  $('li a[href="' + newloc + '"]').parent().addClass('active');
  
  if(locations == "/" || locations == "")
  {
    $('li a[href="./index.php"]').parent().addClass('active');
  }*/


	//ic auto add dash
  $('#ic').keyup(function(){
    var len = $('#ic').val().length;
    
    if(len >= 6 && len < 7)
    {
      $('#ic').val($('#ic').val()+"-");
    }
    if(len >= 9 && len < 10)
    {
      $('#ic').val($('#ic').val()+"-");
    }
  });

  $('#membershipFName').keyup(function(){
    var upper = $('#membershipFName').val().toUpperCase();
    $('#membershipFName').val(upper);
  });

  //click register membership - CODE HASSAN
  $('#registerMember').click(function(){
    event.preventDefault();

    if($('#membershipFName').val() == ""){$('#nameIn').addClass("form-group has-error");}
    else{$('#nameIn').removeClass("form-group has-error").addClass('form-group');}

    if($('#dob').val() == ""){$('#dobIn').addClass('form-group has-error');}
    else{$('#dobIn').removeClass("form-group has-error").addClass('form-group');}

    if($('#ic').val() == ""){$('#icIn').addClass('form-group has-error');}
    else{$('#icIn').removeClass("form-group has-error").addClass('form-group');}

    if($('#email').val() == "" || $('#email').val().search("@") == -1){$('#emailIn').addClass('form-group has-error');}
    else{$('#emailIn').removeClass("form-group has-error").addClass('form-group');}

    if($('#phone').val() == ""){$('#phoneIn').addClass('form-group has-error');}
    else{$('#phoneIn').removeClass("form-group has-error").addClass('form-group');}

    if($('#membershipFName').val() == "" && $('#dob').val() == "" && $('#ic').val() == "" && $('#email').val() == "" && $('#email').val().search("@") == -1 && $('#phone').val() == "")
    {
      alertify.alert("Please complete the form. Fill all the required fields.");
    }

    if($('#membershipFName').val() != "" && $('#dob').val() != "" && $('#ic').val() != "" && $('#email').val() != "" && $('#email').val().search("@") != -1 && $('#phone').val() != "")
    {
      alertify.confirm("<i class='fa fa-fw fa-warning'></i> Register membership?",function(){

        $('.overlay').show();
        $('.sk-circle').show();
        $.post("./process.php", $('#registerMemberForm').serialize(), function(data){
                        
          $('.overlay').hide();
          $('.sk-circle').hide();
                  
          alertify.alert(data);
          $('#registerMemberForm')[0].reset();

        });
      });
    }

  });
  
  //click contact us form submit
  $('#contactUsSubmit').click(function(){
    event.preventDefault();

    if($('#name').val() == ""){$('#nameIn').addClass("form-group has-error");}
    else{$('#nameIn').removeClass("form-group has-error").addClass('form-group');}

    if($('#email').val() == "" || $('#email').val().search("@") == -1){$('#emailIn').addClass('form-group has-error');}
    else{$('#emailIn').removeClass("form-group has-error").addClass('form-group');}

    if($('#message').val() == ""){$('#messageIn').addClass('form-group has-error');}
    else{$('#messageIn').removeClass("form-group has-error").addClass('form-group');}

    if($('#name').val() == "" && $('#email').val() == "" && $('#email').val().search("@") == -1 && $('#message').val() == "")
    {
      alertify.alert("Please complete the form. Fill all the required fields.");
    }
    
    if($('#name').val() != "" && $('#email').val() != "" && $('#email').val().search("@") != -1 && $('#message').val() != "")
    {

      alertify.confirm("<i class='fa fa-fw fa-warning'></i> Send message?",function(){
      
          $('.overlay').show();
          $('.sk-circle').show();

          $.post("./process.php", $('#contactUsForm').serialize(), function(data){
            
            $('.overlay').hide();
            $('.sk-circle').hide();
            
            alertify.alert(data);
            $('#contactUsForm')[0].reset();

          });

        });
    }

  });

  //list upcoming book homepage
  $(function(){
      if($('#homepage').length > 0){

        $('#listUpcomingBookHomepage').empty();
        
        $.post("./process.php", "option=listupcomingHomepage", function(data){
          $('#listUpcomingBookHomepage').append(data).hide().fadeIn('slow');
        });
      } 
  });

  //list e-books homepage
  $(function(){
      if($('#EbooksListPage').length > 0){
        //#$(EbooksListPage) is variable
        $('#listAllEbooks').empty();
        
        $.post("./process.php", "option=listEbooksHomepage", function(data){
          $('#listAllEbooks').append(data).hide().fadeIn('slow');
        });
      } 
  });  

  //---------START SEARCH BOOKS SCRIPT - HUSSIN----------
  //populate select box in search bar
  $(function(){
      if($('#searchPage').length > 0){
        //book genres
        $.post("./process.php", "option=selectbox&type=bgenres", function(data){
            $('#bgenre').append(data);
        });
        //book language
        $.post("./process.php","option=selectbox&type=blang", function(data){
            $('#blang').append(data);
        });
      } 
  }); 
  //modal show book details
  $(document).on("click",'#modals',function(){
    event.preventDefault();
    $("#modalpages").empty();
    var id = $(this).val();
    $.post("./process.php","option=modal&ids="+id,function(data){
      $("#modalpages").append(data);
    });
  });
  
  //search new & pagination
  $('#searchsub').click(function(){
    event.preventDefault();
    $("#list").empty();
	var numpage = $('#curpage').val();
	listall(numpage);
  });
  
  function listall(numpage){
	  $('.overlay').show();
      $('.sk-circle').show();
	  
	  $.post("./process.php","option=search&"+$('#searchBookForm').serialize()+'&pagenum='+numpage,function(data){
        $("#list").append(data).hide().fadeIn();
		$('.overlay').hide();
        $('.sk-circle').hide();
      });
  }
  
  //change page jQuery
	$(document).on('click', '#changepage', function() {
		var numpage = $(this).val();
		$('#list').empty();
		listall(numpage);
	});
  //end paging
  
  
  //search lang&genre
  $(function(){
    if($("#searchPage").length > 0){
      $.post('./process.php','option=searchlanguage',function(data){
          $("#blang").append(data);
      });   
      $.post('./process.php','option=searchgenre',function(data){
        $('#bgenre').append(data);
      });
    } 
  }); 


  //-------------END SEARCH BOOKS SCRIPTS--------

  //------START SHOW NEWEST BOOK HOMEPAGE-----
   $(function(){
    if($('#homepage').length > 0) {
      $('#listNewestEducation').empty();
      $('#listNewestSciFi').empty();
      $('#listNewestNovel').empty();
      $('#listNewestOthers').empty();

      //education
      $.post('./process.php','option=listnewestbook&bookgenre=education',function(data){
        $('#listNewestEducation').append(data).hide().fadeIn("slow");
      });

      //scifi
      $.post('./process.php','option=listnewestbook&bookgenre=scifi',function(data){
        $('#listNewestSciFi').append(data).hide().fadeIn("slow");
      });

      //novel
      $.post('./process.php','option=listnewestbook&bookgenre=novel',function(data){
        $('#listNewestNovel').append(data).hide().fadeIn("slow");
      });

      //others
      $.post('./process.php','option=listnewestbook&bookgenre=others',function(data){
        $('#listNewestOthers').append(data).hide().fadeIn("slow");
      });

    }
  });

   //--------END NEWEST BOOK HOMEPAGE---------


  
	//--------slides show script--------
  $(function(){
    if($('#homepage').length > 0) {
      var jssor_1_SlideshowTransitions = [
              {$Duration:1200,$Opacity:2}
            ];
            
            var jssor_1_options = {
              $AutoPlay: true,
              $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_1_SlideshowTransitions,
                $TransitionsOrder: 1
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              }
            };
            
            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
            
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizing
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 1920);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
    }
  });
	

  });
