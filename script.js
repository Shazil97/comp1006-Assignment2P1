
           //ASKING FOR CONFIRMATION TO DELETE THE RECORD FROM THE TABLE

function confirmDelete() {
    return confirm('Are you sure you want delete this');
}

function comparePasswords(){
    var pw1 = document.getElementById('password').value;
    var pw2 = document.getElementById('confirm').value;
    var PswMsg = document.getElementById('PswMsg');


    console.log(pw1);
    console.log(pw2);

    if(pw1 != pw2){
        PswMsg.innerText = 'Password does not match';
        PswMsg.className = 'text-danger';
        return false;
    }
    else {
        PswMsg.innerText ='';
        PswMsg.className='';
        return true;
    }
}