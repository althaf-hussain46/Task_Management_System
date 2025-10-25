

document.getElementById("adminName").addEventListener("keydown",(event)=>{

    
    
    if(event.key == "Enter"){
            event.preventDefault();
            let admin_pass = document.getElementById("adminPassword");
            if(admin_pass){
                admin_pass.focus();
                admin_pass.select();
            }
    }
})


document.getElementById("adminPassword").addEventListener("keydown",(event)=>{

    
    
    if(event.key == "Enter"){
            event.preventDefault();
            let admin_login_btn = document.getElementById("adminLoginBtn");
            if(admin_login_btn){
                admin_login_btn.focus();
            }
    }
})