$(document).ready(function(){


    ////strat adding new category///
$(".form-add-category").submit(function(e){ 
    e.preventDefault();
    var formData=new FormData(this); 
    $.ajax({
      url:'category_option.php?do=insert',
      type: 'POST',
      data:formData,
      dataType: 'json',
      success:function (data){
        $('.msg').html(data.msg);
        $('table tbody').append(data.catname);
      },
      error:function(data){
        alert('This categoriy is existe');
    },
      contentType:false,
      processData:false,
      cache:false
      }); 
  });
   ////strat updating new category///
$(".form-edit-category").submit(function(e){ 
    e.preventDefault();
    var formData=new FormData(this); 
    $.ajax({
      url:'category_option.php?do=Edite',
      type: 'POST',
      data:formData,
      success:function (data){
        $('.msg').html(data);
      },
      error:function(data){
        alert('This categoriy is existe');
    },
      contentType:false,
      processData:false,
      cache:false
      }); 
  });
///start delete category //////

$('.delete').click(function(){
    href=$(this).attr('href');
    id=$(this).data('id');
    if(confirm('are you sure ?')){
        $.ajax({
            url:href,
            type: 'GET',
            data:{id:id},
            success:function (data){
            $(".msg").html(data);
            $('.Delete'+id).hide('slow');
            },
            });};
});
//////start approve poste////
$('.approve').click(function(){
  id=$(this).data('id');
  href=$(this).attr('href');
  if(confirm('are you sure ?')){
      $.ajax({
          url:href,
          type: 'GET',
          data:{id:id},
          success:function (data){
          },
          });};
});
//////start delete multiple poste from dashboared///

$( '.option input').click(function(){
  if($(this).is(':checked')){
    $(this).closest('.post-line').addClass('removerow');
  }else{
    $(this).closest('.post-line').removeClass('removerow');
  }
});

$( '.multi_delete').click(function(){
  var multi=$('#checked:checked');
  if(multi.length>0){
    var checkbox_value=[];
    $(multi).each(function(){
      checkbox_value.push($(this).val());
    });
    if(confirm('are you sure ?')){
      $.ajax({
          url:'dashboared_option.php?do=Delete',
          type: 'POST',
          data:{id:checkbox_value},
          success:function (data){
          $(".removerow").hide(1000);
          },
          });};
  }else{
    alert("Select atleast one records");
  }
  
});

});

///////// add class to btn approve///
var btns=document.querySelectorAll('.approve');
    btns.forEach((btn)=>{
      btn.addEventListener('click',() =>{
            if(btn.classList.contains('btn-success')){
              btn.classList.remove('btn-success');
              btn.classList.add('btn-danger');
            }else if(btn.classList.contains('btn-danger')){
              btn.classList.remove('btn-danger');
              btn.classList.add('btn-success');
            }
      
          }
      );
        });

        ///////// add class hide to burger navbar///
const burger=document.querySelector('.burger');
const nav=document.querySelector('.links');
  burger.addEventListener('click',() =>{
        if(nav.classList.contains('hide')){
          nav.classList.remove('hide');
        }else {
          nav.classList.add('hide');
        }
  
      });
    
//// slect all posts from dashboared page
const all=document.getElementById('checked_all');
const all_box=document.querySelectorAll('.select_all');
if(all != undefined){
 all.addEventListener('click',()=>{
   all_box.forEach((all)=>{
      all.setAttribute('checked','checked');
   });
 });
}
