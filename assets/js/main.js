$(function () {
  console.log("Ready1!");

  //Aplica clase active al menu nav
  try {
      let currPage = document.location.href.match(/[^\/]+$/)[0];
    if (currPage == 'amigos.php') {
        $('.navbar-nav li:nth-child(2)').addClass('active');
    }else{
        $('.navbar-nav li:nth-child(1)').addClass('active');
    }
  } catch (error) {}
  
  $('.candidatos > div').click(function (e) { 
   $(this).find('input:radio')[0].checked = true;
   $('#votar').prop("disabled", false);
  });

  




});
