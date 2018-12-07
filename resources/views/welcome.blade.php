 <!DOCTYPE html>
 <html lang="{{ app()->getLocale() }}">
 <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- iOS web-app metas -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <link rel="shortcut icon" href="http://www.oren-epstein.com/favicon.ico">
        <link href="https://fonts.googleapis.com/css?family=Oswald|Nunito|Roboto+Slab|Ubuntu|Bitter|Antic+Slab|PT+Sans" rel="stylesheet"> 
        <script src="https://unpkg.com/vue-recaptcha@latest/dist/vue-recaptcha.min.js"></script>
        <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer></script>

    <title>Oren-Epstein.com</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->

     <title>Oren Epstein.com</title>
     <link rel="stylesheet" type="text/css" href="./css/app.css">
     <script async defer src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.0.0/masonry.pkgd.min.js"></script>
     <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
     <style>
        
        html, body {
                background-color: #ECEAE0;
                color: #636b60;
                font-family: 'Nunito', sans-serif;
                font-weight: 700;
                height: 100vh;
                margin: 0;
                
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #000;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;

            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .navbar {
                padding: 0.1rem 0.1rem;
                padding-top: 0.1rem;
                padding-right: 1rem;
                padding-bottom: 0.1rem;
                padding-left: 1rem;
            }

            .footer {
              position: fixed;
              text-align: left;
              bottom: 0;
              left: 0;
              width: 100%;
              height: 60px; /* Set the fixed height of the footer here */
              line-height: 60px; /* Vertically center the text there */
              background-color: #393f4d;
              margin-top:100px;

            }
            .gravatar {
                border-radius: 20px;
                margin-top: 5px;
            }

            .greenies {
                color: #7ebc59;
                font-weight: bold;
            }
            h1 {
                font-family: 'Antic Slab';
                font-size: 30px !important;
                font-weight: 700;
                letter-spacing: 0px;
               /* color: #000;*/
                text-transform: none !important;
                margin-top: 15px;
                line-height: 48px !important;
            }
            .blackout{
                background-color: #393f4d;
            }
            #navbarHeader{
                min-height: 350px;
                overflow: scroll;
            }
            a {
                color: #b6852a;
                text-decoration: none !important;
            }
            .rc-anchor-invisible-text .rc-anchor-pt {
                transition: opacity 0.3s ease;
                z-index: 100;
                top:0;
                left:0;
            }

    </style>
 </head>
 <body>
    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div id="about">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
                  <Kungfu></Kungfu>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
                  <contactme></contactme>
            </div>
          </div>
        </div>

        </div>
      </div>
      <div class="navbar navbar-dark  fixed-top shadow-sm blackout">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            
            
            {{-- gravatar --}}
            <img src="http://www.gravatar.com/avatar/854deea1ae4a7940041f562e250a3107?d=&amp;s=200 width=" 40px"="" height="40px" class="gravatar">
            <img src="./oe_img/NameLogo50h.png" style="margin-top: 20px;">

          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation" style="border:1px solid #A18C70">
            <span class="text-white">Contact Info, Kung-Fu, and more!</span>
          </button>
        </div>
      </div>
    </header>

<div style="clear:both; margin-top: 100px;"></div>
    <div class="container" >
        {{-- main app --}}
        <div id="app">
            <hr>
            <div class="row" align="center">
                <div class="col-md-8 offset-md-2">
                    <h1>Hello, and<span class="greenies"> Welcome</span> to my home on the web!</h1>
                </div>  
            </div>
            <hr>
           <div class="row">

                <div class="col-md-6">
                    <greeting></greeting>
                    <skills></skills>  
               </div>
              
                <div class="col-md-6">
                    <dewpoint></dewpoint>
                    <contacts></contacts>
                    <testimonials></testimonials>
                    <spotify></spotify>  

                </div>
           </div>

          
           
    </div>{{-- end main app --}}

        {{-- masonry grid --}}
        <div class="container" >
            <div id="vue-instance">
                <router-view></router-view>
                <masonry></masonry>
            </div>
        </div>

    <footer class="footer" style="z-index: 1;">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <span class="text-muted">
            <div id="aboutFooter">
            <contactmefooter></contactmefooter>
            </div>
            </span>
        </div>
       
        
      </div>
    </footer>

 <script src="./js/app.js"></script>


 </body>
 </html>