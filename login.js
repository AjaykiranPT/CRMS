const container=document.querySelector('.container');
const forgotlink=document.querySelector('.forgotlink');
const loginlink=document.querySelector('.loginlink');
//const login=document.querySelector('.login');
forgotlink.addEventListener('click',()=>{
    container.classList.add('active');
})
loginlink.addEventListener('click',()=>{
    container.classList.remove('active');
})

 function loginValidation(){
        alert("USERNAME AND PASSWORD NOT NULL");
//     // const username=document.getElementById('username');
//     // const password=document.getElementById('password');
//     // if(username.value==''|| password.value=='' ){
    
//     // }
 }