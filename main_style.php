@keyframes bounceup {
    0% {
        margin-left: auto;
        margin-right: auto;
        animation-timing-function: ease-in;
        opacity: 1;
        transform: translateY(45px);
    }

    24% {
        opacity: 1;
    }

    40% {
        animation-timing-function: ease-in;
        transform: translateY(24px);
    }

    65% {
        animation-timing-function: ease-in;
        transform: translateY(12px);
    }

    82% {
        animation-timing-function: ease-in;
        transform: translateY(6px);
    }

    93% {
        animation-timing-function: ease-in;
        transform: translateY(4px);
    }

    25%,
    55%,
    75%,
    87% {
        animation-timing-function: ease-out;
        transform: translateY(0px);
    }

    100% {
        animation-timing-function: ease-out;
        opacity: 1;
        transform: translateY(0px);
    }
}

@keyframes curtain_open{
    0% {
        animation-timing-function: ease-in;
        opacity: 0;
        transform: translateX(-100%);
    }

    24% {
        opacity: 0;
    }

    40% {
        animation-timing-function: ease-in;
        transform: translateX(-10%);
    }

    65% {
        animation-timing-function: ease-in;
        transform: translateX(-10%);
    }

    82% {
        animation-timing-function: ease-in;
        transform: translateX(-10%);
    }

    93% {
        animation-timing-function: ease-in;
        transform: translateX(-10%);
    }

    25%,
    55%,
    75%,
    87% {
        animation-timing-function: ease-out;
        transform: translateX(-10%);
    }

    100% {
        animation-timing-function: ease-out;
        opacity: 1;
        transform: translateX(-10%);
    }
}

.main_logo {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
    max-width: 300px; /* Maximum width for the logo */
    border-style: solid;
    border-width: 2px;
    border-color: black;
    border-radius: 30px; /* Adjust the radius as needed */
    padding: 10px; /* Add padding for spacing inside the logo container */
    box-sizing: border-box; /* Include padding in the width calculation */
}

#menu_button {
    color: #FF0000; /* Red text color */
    position: fixed;
    display: block;
    margin-left: auto;
    margin-right: auto;
    left: 0;
    right: 0;
    width: 20%;
    max-width: 500px; /* Maximum width for the button */
    border-style: solid;
    border-width: 2px;
    border-color: black;
    border-radius: 30px; /* Adjust the radius as needed */
    padding: 10px; /* Add padding for spacing inside the button container */
    box-sizing: border-box; /* Include padding in the width calculation */
    top: 90%; /* Position 50% from the top of the viewport */
    transform: translateY(-50%); /* Move the button up by half its height to center it vertically */
}

.menu {
    display: none; /* Hide the menu by default */
    position: fixed;
    top: 70%;
    left: 50%;
    margin-left: auto;
    margin-top: auto;
    transform: translate(-50%, -50%);
    background-color: rgba(0, 0, 0, 0.7);
    padding: 10px;
    border: 1px solid #ccc;
    border-top-left-radius: 7%;
    border-top-right-radius: 7%;
    width: 70%;
    text-align: center;
    animation-name: bounceup; /* Assign the keyframe animation */
    animation-duration: 1s; /* Animation duration */
    animation-timing-function: ease; /* Animation timing function */
    }


.menu.show {
    display: block; /* Show the menu when the 'show' class is added */
}

.menu a {
    display: block;
    padding: 5px 0;
    text-decoration: none;
    color: #ffffff;
    border-bottom: 2px solid black ;
    border-width: 1px;
    padding: 3px;
    
    border-color: black;
}

.menu_icon {
    display: block;
    margin-left: auto;
    margin-right: auto;
    
    width: 15%;
    height: 15%;
    max-width: 100px; /* Maximum width for the logo */
    border-bottom: 2px solid white; /* Border only on the bottom */
    border-radius: 2px; /* Adjust the radius as needed */
    padding: 1px; /* Add padding for spacing inside the logo container */
    box-sizing: border-box;
}

#fun_text{
        font-family: 'Comic Sans Ms', cursive; /* Change the font to Arial or any other desired font */
        font-size: 25px; /* Optionally set the font size */
        font-weight: bold; /* Optionally set the font weight */
        color: #fff6f6; /* Optionally set the font color */

}

.blur {
    filter: blur(5px);
}

body{
    background: linear-gradient(133deg, #ff9500 0%, #260080 100%);
}