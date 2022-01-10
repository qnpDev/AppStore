$(window).ready(function () {
    // nav //
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar, #content, .top-nav, #main-content, .btnsearch').toggleClass('active');
    });
    // btn scroll top //
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    $('#back-to-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 400);
        return false;
    });

    // btn login //
    function errlogin(s){
        $('.invalid-login').html(s);
            $('.invalid-login').css('display','block');
    }
    $('#btnlogin').on('click',function (){
        
       let user = $('#usernamelogin').val();
       let pass = $('#passwordlogin').val();
       let checkremember = $('#rememberlogin').prop('checked');
       
       if(user=="" || pass==""){
            errlogin("Please enter your Username or Password!");
        }else if(pass.length<6){
            errlogin("Password must more than 6 characters");
        }else{
            $.ajax({
                url: "ajax/check.php",
                type: "POST",
                data: {
                    type:1,
                    username:user,
                    password:pass,
                    remember:checkremember
                },
                success: function(result){
                    if(result==1){
                        $('.login-success').modal();
                        setTimeout(function(){
                            window.location.href="home";
                        },500)
                    }else{
                        errlogin("Username or Password are incorrect!")
                    }
                }
            });
        }
    });
    
    // regis //
    function errregis(s){
        $('.invalid-login').html(s);
            $('.invalid-login').css('display','block');
    }
    
    $('#btnregis').on('click',function (){
       let user = $('#usernameregis').val();
       let pass = $('#passwordregis').val();
       let email = $('#emailregis').val();
       
       let testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
       let testuser = /^[a-zA-Z0-9_-]+$/;
       if(user==""){
            errregis("Please enter your Username");
        }else if(email==""){
            errregis("Please enter your email");        
        }else if(!testuser.test(user)){
            errregis("Username only include a-z, A-Z, -, _, or 0-9");   
        }else if(!testEmail.test(email)){
            errregis("Email is incorrect!");
        }else if(pass==""){
            errregis("Please enter your password");
        }else if(pass.length<6){
            errregis("Password must more than 6 characters");
        }else{
            $.ajax({
                url: "ajax/check.php",
                type: "POST",
                data: {
                    type:2,
                    username:user,
                    password:pass,
                    email:email
                },
                success: function(result){
                    if(result==2){
                        $('.regis-success').modal();
                        $('.regis-user').html(user);
                        setTimeout(function(){
                            window.location.href="login";
                        },2000);
                    }else if(result==0){
                        errregis("Username already have!");
                    }else if(result==1){
                        errregis("Email already have!")
                    }
                }
            });
        }
    });
    
    
    
    
    // forgot //
    $('#btn-forgot').on('click',function (){
       $('#forgot-loading').removeClass("d-none");
       let email = $('#email-forgot').val();
       let testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
       
       if(email==""){
            errlogin("Please enter your Email!");
            $('#forgot-loading').addClass("d-none");
        }else if(!testEmail.test(email)){
            errlogin("Email is incorrect!");
            $('#forgot-loading').addClass("d-none");
        }else{
            $.ajax({
                url: "ajax/check.php",
                type: "POST",
                data: {
                    type:3,
                    email:email
                },
                success: function(result){
                    $('#forgot-loading').addClass("d-none");
                    if(result==1){
                        $('#forgotModal').modal('show');
                    }else if(result==0){
                        errlogin("Send Faise!");
                    }else if(result==2){
                        errlogin("Email not exists!");
                    }
                }
            });
        }        
    });
    
    
    
    // detail seemore //
    $('#detail-btn-seemore').on('click',function(){
        $('#detail-mota-default').slideToggle("slow");
        $('#detail-seemore').slideToggle("slow");
    });

    // search //
    $('#message-search').on("keyup input", function(){
        /* Lấy giá trị đầu vào khi có thay đổi */
        let urlHome = window.location.origin
        let inputVal = $(this).val();
        let resultDropdown = $(this).siblings("#result-search");
        if(inputVal.length){
            $.get(urlHome+"/ajax/search.php", {term: inputVal}).done(function(data){
                // Hiển thị dữ liệu trả về trong trình duyệt
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    

// /search //
    
});

//change pass //
function errpass(s){
        $('.invalid-login').html(s);
            $('.invalid-login').css('display','block');
    }
function passChange(id){
    let pold = $('#pass-change-old').val();
    let pnew = $('#pass-change-new').val()
    let pnew1 = $('#pass-change-new-again').val();
    let urlHome = window.location.origin

    if(pold==""){
        errpass("Please enter Old password");
    }else if(pold.length<6){
        errpass("Old pass must more than 6");
    }else if(pnew==""){
        errpass("Please enter new password");
    }else if(pnew.length < 6){
        errpass("New pass must more than 6");
    }else if(pnew===pold){
        errpass("New pass like Old pass");
    }else if(pnew1==""){
        errpass("Please enter new password again");
    }else if(pnew != pnew1){
        errpass("New password again not same");
    }else{
        $.ajax({
            url: "ajax/check.php",
            type: "POST",
            data: {
                type:4,
                uid:id,
                pold:pold,
                pnew:pnew
            },success: function(result){
                if(result==1){
                    $('.login-success').modal();
                    setTimeout(function(){
                        window.location.href=urlHome+"/login";
                    },1000);
                }else{
                    errpass("Old password are incorrect!")
                }
            }
        });

    }
}


function search(id) {
        let urlHome = window.location.origin
        window.location.replace(urlHome+"/app-"+id);
    }

// home page //
function pageHomeApp(index, total) {
    let resultDropdown = $('#home-item');
    let listpage = $('#home-page');
    let limit = $('#home-page-limit').val();
    $.get("ajax/home.php",
            {
                pageHome: index,
                limit: limit
            }).done(function (data) {
        resultDropdown.empty();
        resultDropdown.html(data);

        listpage.empty();

        let htmlListPage = "";
        if (index > 1) {
            htmlListPage += "<li onclick='pageHomeApp(" + (index - 1) + "," + total + ")' class='page-item cursor-pointer'><a class='page-link'>&lt;</a></li>";
        }
        htmlListPage += "<li class='page-item active'><a class='page-link'>" + index + "</a></li>";
        if(index < Math.ceil(total/limit)){
            htmlListPage += "<li onclick='pageHomeApp(" + (index + 1) + "," + total + ")' class='page-item cursor-pointer'><a class='page-link'>&gt;</a></li>";
        }
        listpage.html(htmlListPage);
    });
}


// home-item-type //
function homePageType() {
    let typeSelected = $('#home-page-type').val();
    
    $.ajax({
        url: "ajax/home.php",
        type: "POST",
        dataType: 'json',
        cache: false,
        data: {
            type: 'typeChange',
            typeChange : typeSelected
        }, success: function (result) {
            $('.home-item-type').remove();
            $('#btn-home-seemore-type').attr("href","app/"+typeSelected);
            if(result.length == 0){
                $('#home-item-type').append("<div class='home-item-type col-12 text-center alert alert-danger'>Danh sách rỗng !</div>");
            }else{
                for (let i = 0; i < result.length; i++) {
                    let price = (result[i]['price'] == 0) ? "<i class='fa fa-money text-success font-weight-bold' aria-hidden='true'></i><span class='text-danger font-weight-bold'> Free</span>" : "<i class='fa fa-money text-success font-weight-bold' aria-hidden='true'></i><span class='text-danger font-weight-bold'> " + result[i]['price'] + "</span><span class='currency'> đ</span>";
                    $('#home-item-type').append("<div class='col-12 col-sm-6 col-lg-4 col-xl-3 home-item-type'><div class='card card-item-home btn'><a class='link-item-home' href='app-" + result[i]['id'] + "'><img class='card-img-top rounded' src='img/app/"+ result[i]['icon'] +"' alt='App'><div class='card-body'><h5 class='card-title font-weight-bold'>" + result[i]['name'] + "</h5><p class='card-text index-mota'>" + result[i]['mota'] + "</p></div><div class='card-footer'><div class='star-item-home'><i class='fa fa-star font-weight-bold text-warning' aria-hidden='true'></i><span class='text-primary font-weight-bold'> " + result[i]['rate'] + "</span></div><div class='price-item-home'>" + price + "</div></div></a></div></div>");
                }
            }
            
        }
    });
    
}
// /home-item-type //

// apps page //
function appsPage(index, total) {
    let resultDropdown = $('#home-item');
    let listpage = $('#home-page');
    let limit = $('#home-page-limit').val();
    $.get("../ajax/home.php",
            {
                pageHome: index,
                limit: limit
            }).done(function (data) {
        resultDropdown.empty();
        resultDropdown.html(data);

        listpage.empty();

        let htmlListPage = "";
        if (index > 1) {
            htmlListPage += "<li onclick='appsPage(" + (index - 1) + "," + total + ")' class='page-item cursor-pointer'><a class='page-link'>&lt;</a></li>";
        }
        htmlListPage += "<li class='page-item active'><a class='page-link'>" + index + "</a></li>";
        if(index < Math.ceil(total/limit)){
            htmlListPage += "<li onclick='appsPage(" + (index + 1) + "," + total + ")' class='page-item cursor-pointer'><a class='page-link'>&gt;</a></li>";
        }
        listpage.html(htmlListPage);
    });
}



function appsPageType(index, total, typeSelected) {
    let resultDropdown = $('#home-item');
    let listpage = $('#home-page');
    let limit = $('#home-page-limit').val();
    $.get("../ajax/home.php",
            {
                pageType: index,
                limit: limit,
                typeSelected: typeSelected
            }).done(function (data) {
        resultDropdown.empty();
        resultDropdown.html(data);

        listpage.empty();

        let htmlListPage = "";
        if (index > 1) {
            htmlListPage += "<li onclick='appsPageType(" + (index - 1) + "," + total + ",\"" + typeSelected + "\")' class='page-item cursor-pointer'><a class='page-link'>&lt;</a></li>";
        }
        htmlListPage += "<li class='page-item active'><a class='page-link'>" + index + "</a></li>";
        if(index < Math.ceil(total/limit)){
            htmlListPage += "<li onclick='appsPageType(" + (index + 1) + "," + total + ",\"" + typeSelected + "\")' class='page-item cursor-pointer'><a class='page-link'>&gt;</a></li>";
        }
        listpage.html(htmlListPage);
    });
}

function logout(){
    let count = 3;
    let settime = setInterval(function () {
        count -= 1;
        document.getElementById('time-countdown-logout').innerHTML = count;
        if (count <= 0) {
            clearInterval(settime);
            location.href = 'home';
        }
    }, 1000);
}

// /apps page //


// detail //
function addActiveSlideDetail() {
    document.getElementsByClassName("detail-item-photo")[0].classList.add("active");
}

function detailSeemoreBtn() {
  let dots = document.getElementById("detail-dots");
  let moreText = document.getElementById("detail-more");
  let btnText = document.getElementById("detail-seemore-btn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "..Read more..";
    moreText.style.display = "none";
    dots.style.transition = "all 0.6s"
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "..Read less..";
    moreText.style.display = "inline";
    dots.style.transition = "all 0.6s"
  }
}


function buyApp(aid,uid,token){
    $("#buyModal").modal('hide');
    $("#detail-paid").addClass('d-none');
    $("#detail-paid-loading").removeClass('d-none');
    $.ajax({
        url: "ajax/app.php",
        type: "POST",
        data: {
            type: 'buyApp',
            aid: aid,
            uid: uid,
            token: token,
        },
        success: function (result) {
            $("#detail-paid").removeClass('d-none');
            $("#detail-paid-loading").addClass('d-none');
            if(result == 0){
                $('#detail-no-money').removeClass("d-none");
            }else{
                let button = $("#btn-download");
                button.empty();
                let already = "<button onclick='buyAppAgain(" + aid + ",\"" + token + "\")' class='btn btn-success' type='button'> <i class='fa fa-download' aria-hidden='true'></i> Download</button>";
                button.html(already);
                window.location.replace("app/download/"+result);
            }
        }
    });
}

function buyAppFree(aid,uid,token){
    $.ajax({
        url: "ajax/app.php",
        type: "POST",
        data: {
            type: 'buyAppFree',
            aid: aid,
            uid: uid,
            token: token
        },
        success: function (result) {
            let button = $("#btn-download");
            button.empty();
            let already = "<button onclick='buyAppAgain(" + aid + ",\"" + token + "\")' class='btn btn-success' type='button'> <i class='fa fa-download' aria-hidden='true'></i> Download</button>";
            button.html(already);
            window.location.replace("app/download/"+result);
        }
    });
}

function buyAppAgain(aid,token){
    $.ajax({
        url: "ajax/app.php",
        type: "POST",
        cache: false,
        data: {
            type: 'buyAppAgain',
            aid: aid,
            token: token
        },
        success: function (result) {
            window.location.replace("app/download/"+result);
        }
    });
}

// /detail //

// napthe //
function naptien(uid){
    let mathe = $('#naptien-mathe').val();
    let err = $('#naptien-err');
    $.ajax({
        url: "../ajax/check.php",
        type: "POST",
        data: {
            type: 'naptien',
            uid: uid,
            mathe: mathe
        },
        success: function (result) {
            if(result==1){
                err.html("Nạp thẻ thành công! Reload lại trang để cập nhật dữ liệu");
                err.removeClass("alert-danger");
                err.addClass("alert-success");
                err.removeClass("d-none");
            }else{
                err.html("Mã thẻ sai. Vui lòng kiểm tra lại!");
                err.addClass("alert-danger");
                err.removeClass("d-none");
            }
        }
    });
}
// /napthe //

// forgot //
function errrecovery(s){
        $('#forgot-recovery-err').html(s);
            $('#forgot-recovery-err').removeClass('d-none');
    }
function recovery(uid){
    let pass = $('#forgot-recovery').val();
        if(pass==""){
            errrecovery("Please enter password");
        }else if(pass.length<6){
            errrecovery("Pass must more than 6");
        }else{
            $.ajax({
                url: "../ajax/check.php",
                type: "POST",
                data: {
                    type:5,
                    uid:uid,
                    pass:pass
                },success: function(result){
                    if(result==1){
                        $('#recoveryModal').modal('show');
                    }else{
                        errrecovery("Err!");
                    }
                }
            });
            
        }
}
// /forgot //

// create app//
function createAppAddImg(){
    $('#create-add-img').append("<div class='input-group mb-3'><span class='input-group-text'>Hình</span><input class='form-control' type='file' name='img"+Date.now()+"'></div>")
}
// /create app //

function reloadPage(){
    if( window.localStorage ){
        if( !localStorage.getItem('firstLoad') ){
          localStorage['firstLoad'] = true;
          window.location.reload();
        }  
        else
          localStorage.removeItem('firstLoad');
  }
}
    

// theloai //
function typeRemove(ele,id){
    $.ajax({
        url: "../ajax/admin.php",
        type: "POST",
        data: {
            type: 'typeRemove',
            id: id
        },
        success: function (result) {
            if(result == 1){
                $(ele).closest('tr').remove();
            }else if(result == 0){
                alert("Lỗi vì có ứng dụng đang ở thể loại này");
            }else{
                alert("Error");
            }
        }
    });
    
    
}
// /theloai//

// devPage //
function appsDevPage(index, total, devid) {
    let resultDropdown = $('#home-item');
    let listpage = $('#home-page');
    let limit = 4;
    $.get("../ajax/home.php",
            {
                pageDev: index,
                id: devid
            }).done(function (data) {
        resultDropdown.empty();
        resultDropdown.html(data);

        listpage.empty();

        let htmlListPage = "";
        if (index > 1) {
            htmlListPage += "<li onclick='appsDevPage(" + (index - 1) + "," + total + "," + devid + ")' class='page-item cursor-pointer'><a class='page-link'>&lt;</a></li>";
        }
        htmlListPage += "<li class='page-item active'><a class='page-link'>" + index + "</a></li>";
        if(index < Math.ceil(total/limit)){
            htmlListPage += "<li onclick='appsDevPage(" + (index + 1) + "," + total + "," + devid + ")' class='page-item cursor-pointer'><a class='page-link'>&gt;</a></li>";
        }
        listpage.html(htmlListPage);
    });
}
// /devPage //

// dev listapp //
function pageListApp(index, theloai, id) {
    let urlHome = window.location.origin
    let resultDropdown = $('#listapp-list');
    let listpage = $('#page');
    $.get(urlHome + "/ajax/pageListApp.php",
            {
                page: index,
                type: theloai,
                uid: id
            }).done(function (data) {
        resultDropdown.empty();
        resultDropdown.html(data);

        listpage.empty();

        let htmlListPage = "";
        if (index > 1) {
            htmlListPage += "<li onclick='pageListApp(" + (index - 1) + ",\"" + theloai + "\"," + id + ")' class='page-item cursor-pointer'><a class='page-link'>&lt;</a></li>";
        }
        htmlListPage += "<li class='page-item active'><a class='page-link'>" + index + "</a></li>";
        htmlListPage += "<li onclick='pageListApp(" + (index + 1) + ",\"" + theloai + "\"," + id + ")' class='page-item cursor-pointer'><a class='page-link'>&gt;</a></li>";
        listpage.html(htmlListPage);
    });
}
function appRemove(ele, id) {
    if (window.confirm("Bạn chắc chắn muốn xóa nó!")) {

        let urlHome = window.location.origin
        $.ajax({
            url: urlHome + "/ajax/pageListApp.php",
            type: "POST",
            data: {
                type: 'appRemove',
                id: id
            },
            success: function (result) {
                if (result == 1) {
                    $(ele).closest('tr').remove();
                } else {
                    alert("Error");
                }
            }
        });

    }
}

function changeType(id){
    let value = $('#change-type').val();
    pageListApp(1,value,id);
}
function appPublic(ele, id){
    let urlHome = window.location.origin
    let resultDropdown = $(ele).closest('tr');
    $.get(urlHome + "/ajax/pageListApp.php",
            {
                public: id
            }).done(function (data) {
                if(data == 0){
                    alert("Thiếu thông tin để có thể gửi cho Admin duyệt app. Vui lòng kiểm tra lại!");
                }else{
                    resultDropdown.after(data);
                    resultDropdown.remove();
                }

    });
}
function appCancel(ele, id){
    let urlHome = window.location.origin
    let resultDropdown = $(ele).closest('tr');
    $.get(urlHome + "/ajax/pageListApp.php",
            {
                cancel: id
            }).done(function (data) {
                
        resultDropdown.after(data);
        resultDropdown.remove();

    });
}
function appBin(ele, id){
    let urlHome = window.location.origin
    let resultDropdown = $(ele).closest('tr');
    $.get(urlHome + "/ajax/pageListApp.php",
            {
                bin: id
            }).done(function (data) {
                
        resultDropdown.after(data);
        resultDropdown.remove();

    });
}
function appRePublic(ele, id){
    let urlHome = window.location.origin
    let resultDropdown = $(ele).closest('tr');
    $.get(urlHome + "/ajax/pageListApp.php",
            {
                republic: id
            }).done(function (data) {
                
        resultDropdown.after(data);
        resultDropdown.remove();

    });
}

function editDeleteImg(ele, id){
    let urlHome = window.location.origin
    let resultDropdown = $(ele).closest('#image');
    $.get(urlHome + "/ajax/pageListApp.php",
            {
                deleteImg: id
            }).done(function (data) {
        resultDropdown.after("<div class='input-group mb-3'><span class='input-group-text'>Hình</span><input class='form-control' type='file' name='img"+Date.now()+"'></div>");
        resultDropdown.remove();

    });
}
// /dev listapp //


// admin //

function pageAdminListApp(index, theloai) {
    let urlHome = window.location.origin
    let resultDropdown = $('#listapp-list');
    let listpage = $('#page');
    $.get(urlHome + "/ajax/admin.php",
            {
                page: index,
                type: theloai
            }).done(function (data) {
        resultDropdown.empty();
        resultDropdown.html(data);

        listpage.empty();

        let htmlListPage = "";
        if (index > 1) {
            htmlListPage += "<li onclick='pageAdminListApp(" + (index - 1) + ",\"" + theloai + "\")' class='page-item cursor-pointer'><a class='page-link'>&lt;</a></li>";
        }
        htmlListPage += "<li class='page-item active'><a class='page-link'>" + index + "</a></li>";
        htmlListPage += "<li onclick='pageAdminListApp(" + (index + 1) + ",\"" + theloai + "\")' class='page-item cursor-pointer'><a class='page-link'>&gt;</a></li>";
        listpage.html(htmlListPage);
    });
}
function appAdminAccept(ele, id){
    let urlHome = window.location.origin
    let resultDropdown = $(ele).closest('tr');
    $.get(urlHome + "/ajax/admin.php",
            {
                accept: id
            }).done(function (data) {
                
        resultDropdown.after(data);
        resultDropdown.remove();

    });
}
function appAdminRefuse(ele, id){
    let urlHome = window.location.origin
    let resultDropdown = $(ele).closest('tr');
    $.get(urlHome + "/ajax/admin.php",
            {
                refuse: id
            }).done(function (data) {
                
        resultDropdown.after(data);
        resultDropdown.remove();

    });
}
function appAdminUnpublished(ele, id){
    let urlHome = window.location.origin
    let resultDropdown = $(ele).closest('tr');
    $.get(urlHome + "/ajax/admin.php",
            {
                unpublished: id
            }).done(function (data) {
                
        resultDropdown.after(data);
        resultDropdown.remove();

    });
}
function appAdminDelete(ele, id){
    let urlHome = window.location.origin
    let resultDropdown = $(ele).closest('tr');
    $.get(urlHome + "/ajax/admin.php",
            {
                delete: id
            }).done(function (data) {
                
        resultDropdown.remove();

    });
}
function changeAdminType(){
    let value = $('#change-type').val();
    pageAdminListApp(1,value);
}
function pageAdminDuyetListApp(index, theloai) {
    let urlHome = window.location.origin
    let resultDropdown = $('#listapp-list');
    let listpage = $('#page');
    $.get(urlHome + "/ajax/admin.php",
            {
                pageDuyet: index,
                type: theloai
            }).done(function (data) {
        resultDropdown.empty();
        resultDropdown.html(data);

        listpage.empty();

        let htmlListPage = "";
        if (index > 1) {
            htmlListPage += "<li onclick='pageAdminDuyetListApp(" + (index - 1) + ",\"" + theloai + "\")' class='page-item cursor-pointer'><a class='page-link'>&lt;</a></li>";
        }
        htmlListPage += "<li class='page-item active'><a class='page-link'>" + index + "</a></li>";
        htmlListPage += "<li onclick='pageAdminDuyetListApp(" + (index + 1) + ",\"" + theloai + "\")' class='page-item cursor-pointer'><a class='page-link'>&gt;</a></li>";
        listpage.html(htmlListPage);
    });
}
function changeAdminDuyetType(){
    let value = $('#change-type').val();
    pageAdminDuyetListApp(1,value);
}
function pageAdminListUsers(index) {
    let urlHome = window.location.origin
    let resultDropdown = $('#listapp-list');
    let listpage = $('#page');
    $.get(urlHome + "/ajax/admin.php",
            {
                pageListUsers: index
            }).done(function (data) {
        resultDropdown.empty();
        resultDropdown.html(data);

        listpage.empty();

        let htmlListPage = "";
        if (index > 1) {
            htmlListPage += "<li onclick='pageAdminDuyetListApp(" + (index - 1) + ")' class='page-item cursor-pointer'><a class='page-link'>&lt;</a></li>";
        }
        htmlListPage += "<li class='page-item active'><a class='page-link'>" + index + "</a></li>";
        htmlListPage += "<li onclick='pageAdminDuyetListApp(" + (index + 1) + ")' class='page-item cursor-pointer'><a class='page-link'>&gt;</a></li>";
        listpage.html(htmlListPage);
    });
}
function pageAdminListDev(index) {
    let urlHome = window.location.origin
    let resultDropdown = $('#listapp-list');
    let listpage = $('#page');
    $.get(urlHome + "/ajax/admin.php",
            {
                pageListDev: index
            }).done(function (data) {
        resultDropdown.empty();
        resultDropdown.html(data);

        listpage.empty();

        let htmlListPage = "";
        if (index > 1) {
            htmlListPage += "<li onclick='pageAdminListDev(" + (index - 1) + ")' class='page-item cursor-pointer'><a class='page-link'>&lt;</a></li>";
        }
        htmlListPage += "<li class='page-item active'><a class='page-link'>" + index + "</a></li>";
        htmlListPage += "<li onclick='pageAdminListDev(" + (index + 1) + ")' class='page-item cursor-pointer'><a class='page-link'>&gt;</a></li>";
        listpage.html(htmlListPage);
    });
}

function listDevRemove(ele,id){
    if (window.confirm("Bạn chắc chắn muốn xóa Developer + tất cả app của developer này!")) {

        let urlHome = window.location.origin
         $.get(urlHome + "/ajax/admin.php",
            {
                devRemove: id
            }).done(function (data) {
                if (data == 1) {
                    $(ele).closest('tr').remove();
                } else {
                    alert("Error");
                }
            });
        }
}

// /admin //

//users bought //
function pageListBought(index, id, total) {
    let urlHome = window.location.origin
    let resultDropdown = $('#list tr:last');
    let tiep = $('#page');
    let limit = 10;
    $.get(urlHome + "/ajax/bought.php",
            {
                page: index,
                uid: id
            }).done(function (data) {
                //resultDropdown.empty();
                resultDropdown.after(data);
                if(index < Math.ceil(total/limit)){
                    tiep.empty();
                    tiep.html("<button onclick='pageListBought("+(index+1)+","+id+","+total+")' type='button' id='detail-seemore-btn' class='btn btn-light font-weight-bold'>Còn tiếp</button>");
                }else{
                    tiep.empty();
                }
    });
}
        
// /userbought//


// paid app //
function appsPaidPage(index, total) {
    let resultDropdown = $('#home-item');
    let listpage = $('#home-page');
    let limit = $('#home-page-limit').val();
    $.get("../ajax/listpaid.php",
            {
                page: index,
                limit: limit
            }).done(function (data) {
        resultDropdown.empty();
        resultDropdown.html(data);

        listpage.empty();

        let htmlListPage = "";
        if (index > 1) {
            htmlListPage += "<li onclick='appsPaidPage(" + (index - 1) + "," + total + ")' class='page-item cursor-pointer'><a class='page-link'>&lt;</a></li>";
        }
        htmlListPage += "<li class='page-item active'><a class='page-link'>" + index + "</a></li>";
        if(index < Math.ceil(total/limit)){
            htmlListPage += "<li onclick='appsPaidPage(" + (index + 1) + "," + total + ")' class='page-item cursor-pointer'><a class='page-link'>&gt;</a></li>";
        }
        listpage.html(htmlListPage);
    });
}
// paid app //

//free app //
function appsFreePage(index, total) {
    let resultDropdown = $('#home-item');
    let listpage = $('#home-page');
    let limit = $('#home-page-limit').val();
    $.get("../ajax/listfree.php",
            {
                page: index,
                limit: limit
            }).done(function (data) {
        resultDropdown.empty();
        resultDropdown.html(data);

        listpage.empty();

        let htmlListPage = "";
        if (index > 1) {
            htmlListPage += "<li onclick='appsFreePage(" + (index - 1) + "," + total + ")' class='page-item cursor-pointer'><a class='page-link'>&lt;</a></li>";
        }
        htmlListPage += "<li class='page-item active'><a class='page-link'>" + index + "</a></li>";
        if(index < Math.ceil(total/limit)){
            htmlListPage += "<li onclick='appsFreePage(" + (index + 1) + "," + total + ")' class='page-item cursor-pointer'><a class='page-link'>&gt;</a></li>";
        }
        listpage.html(htmlListPage);
    });
}

// Free app//