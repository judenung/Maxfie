<!DOCTYPE html>
<html lang="en">

<head>


    <!--<meta name="csrf-token" content="{{-- csrf_token() --}}">-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Maxfie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
</head>

<body class="antialiased">
    <div class="row mx-auto mb-3 p-0 text-center">
        <div class="col-12 col-md-7 col-lg-7 mx-auto p-0 my-0" style="width: fit-content;">
            <button id="loginButton" class="form-control btn-success btn-lg btn-block py-2 px-3"
                onClick="socialSignin('google');">
                <i class="fa fa-sign-out p-0" aria-hidden="true"></i> Login
            </button>
        </div>
    </div>
    <form class="col-6 mx-auto my-3" id="social-login-form" method="post" action="" style="display: none;">
        @csrf
        <input id="social-login-access-token" name="social_login_access_token" type="hidden">
        <input id="social-login-tokenId" name="social_login_tokenId" type="hidden">
        <input id="email" name="email" type="hidden">
        <input id="name" name="name" type="hidden">
        <input id="photo" name="photo" type="hidden">

    </form>
</body>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Initialize Firebase
    var config = {
        apiKey: "AIzaSyC9sEvG8vcTkjnMjC0IYvNzlrwJTXnMbb8",
        authDomain: "maxfie-mobile-app-77c9e.firebaseapp.com",
        projectId: "maxfie-mobile-app-77c9e",
        storageBucket: "maxfie-mobile-app-77c9e.appspot.com",
        messagingSenderId: "1071919300763",
        appId: "1:1071919300763:web:76be86897266306e34063e"
        // This is the variable you got from Firebase's Firebase SDK snippet. It includes values for apiKey, authDomain, projectId, etc.
    };
    firebase.initializeApp(config);
    //var facebookProvider = new firebase.auth.FacebookAuthProvider();
    var googleProvider = new firebase.auth.GoogleAuthProvider();
    //var facebookCallbackLink = '/login/facebook/callback';
    var googleCallbackLink = '/login/google';
    async function socialSignin(provider) {
        var buttonClick = document.getElementById('loginButton');

        if (buttonClick.disabled == false) {
            buttonClick.disabled = true;
        }
        var socialProvider = null;
        if (provider == "google") {
            socialProvider = googleProvider;
            document.getElementById('social-login-form').action = googleCallbackLink;
        } else {
            return;
        }
        firebase.auth().signInWithPopup(socialProvider).then(function(result) {
            // console.log(result);
            // console.log(result.credential.accessToken);
            document.getElementById('social-login-access-token').value = result.credential.accessToken;
            document.getElementById('email').value = result.user.email;
            document.getElementById('name').value = result.user.displayName;
            //console.log(result.user.photoURL);
            document.getElementById('photo').value = result.user.photoURL;
            //console.log(result.user);
            //document.GoogleAuthProvider('social-login-tokenId').value = result.getIdToken();
            //console.log(result);
            //result.user.getIdToken().then(function(resultr) {
            //console.log(result.user.getIdToken());
            document.getElementById('social-login-tokenId').value = result.credential.idToken;
            document.getElementById('social-login-form').submit();
            // // });
        }).catch(function(error) {
            // do error handling
            console.log(error);
        });
    }
</script>

</html>
