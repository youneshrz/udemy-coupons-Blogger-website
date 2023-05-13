
///========= styling burger navbar mobile
var burger=document.querySelector(".burger") ;
var link=document.querySelector(".link") ;
var container=document.querySelector(".container") ;
var lines=document.querySelectorAll('.line');

burger.addEventListener('click',()=>{
    if(link.classList.contains('hide')){
        link.classList.remove('hide');
        lines.forEach((line,index)=>{
            if(index ==0)
            line.classList.add('line1');
            else if(index==1)
            line.classList.add('line2');
            else line.classList.add('line3');
        });
    }else{
        link.classList.add('hide');
        lines.forEach((line,index)=>{
            if(index ==0)
            line.classList.remove('line1');
            else if(index==1)
            line.classList.remove('line2');
            else line.classList.remove('line3');
        });
    }

    container.addEventListener('click',()=>{
        link.classList.add('hide');
        lines.forEach((line,index)=>{
            if(index ==0)
            line.classList.remove('line1');
            else if(index==1)
            line.classList.remove('line2');
            else line.classList.remove('line3');
        });
    });

});
///====================== styling icon serach

var icon_search=document.querySelector('.icon-search');
//for mobile
var search_mobile=document.querySelector('.search-mobile form');
var search_mobile_input=document.querySelector('.search-mobile form input');
//for Pc
var search_pc_input=document.querySelector('.search form input');

icon_search.addEventListener('click',()=>{
    //for mobile
    if(search_mobile.classList.contains('hide')){
        search_mobile.classList.remove('hide');
        search_mobile_input.classList.remove('hide');
    }   
    else{ search_mobile.classList.add('hide');
        search_mobile_input.classList.add('hide');  
    }     
    //for PC
    if(search_pc_input.classList.contains('hide')){
        search_pc_input.classList.remove('hide');
}   
    else{ search_mobile.classList.add('hide');
    search_pc_input.classList.add('hide');
}     
});
////========= strat styling filter bar =====//
const form=document.querySelector('.filter-form');
const chevron_up=document.querySelector('.fa-chevron-up');
const filter=document.querySelector('.h5-filter');

    filter.addEventListener('click',()=>{
        if(!chevron_up.classList.contains('rotation')){          
            chevron_up.classList.add('rotation');          
        }   
        else{           
            chevron_up.classList.remove('rotation');            
        } 
        if(!form.classList.contains('hide-filter')){
            form.classList.add('hide-filter');
        }else{
            form.classList.remove('hide-filter');
        }
    });
    /// confige all checkbox
    const all=document.getElementById('all');
    let categories=document.querySelectorAll('.categories');
    all.addEventListener('click',()=>{
        categories.forEach((cat)=>{
            cat.setAttribute("checked","checked");
        })
    });
//// scrooll top botton
//Instant scroll to top of page
//window.scrollTo(0, 0);
// Get The Id
var topPage = document.getElementById(`top-page`)

// On Click, Scroll to the Top of Page
topPage.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' })

// On scroll, Show/Hide the button
window.onscroll = () => {
    window.scrollY > 500
    ? (topPage.style.display = 'block')
    : (topPage.style.display = 'none')
}

//* give lates products position fixed *//
    


$(document).ready(function(){

    
    //insert contact into data bas //
    $("#contact").submit(function(e){ 
        e.preventDefault();
        var formData=new FormData(this); 
        $.ajax({
        url:'contact.php?do=insert',
        type: 'POST',
        data:formData,
        success:function (data){
        $('.msg').html(data);
        },
        error:function(data){
        alert('Same thing wronge');
        },
        contentType:false,
        processData:false,
        cache:false
        }); 
    });

});
