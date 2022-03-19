
<div class="base">

    <div class="creatures">
    <div class="human">
        <div class="hat"></div>
        <div class="head">
        <div class="eyes left">
            <div class="blink"></div>
        </div>
        <div class="eyes right">
            <div class="blink"></div>
        </div>
        <div class="mouth"></div>
        </div>
        <div class="body">
        <div class="top"></div>
        <div class="bow"></div>
        <div class="left side"></div>
        <div class="right side"></div>
        <div class="shirt">
            <div class="buttons">
            <div class="button"></div>
            <div class="button"></div>
            <div class="button"></div>
            </div>
        </div>
        </div>
        <div class="legs">
        <div class="leg left"></div>
        <div class="leg right"></div>
        </div>
        <div class="feet"></div>
        <div class="ground"></div>
    </div>
    </div>

</div>

<style>
    .base {
        width: 80%;
        height: 80vh;
        margin: 10px auto;
        overflow: hidden !important;
        border-radius: 10px;
    }
    .creatures {
  width: 100%;
  height: 100%;
  background-color: #3567aa;
  position: relative;
  top: 0;
  left: 0;
} 

.human {
  width: 100%;
  height: 100%;
  float: left;
  background-color: #3567aa;
  overflow: hidden;
}

.hat {
  margin: 10% auto -18px;
  width: 90px;
  height: 60px;
  background-color: rgb(31,33,43); 
  border-radius: 3px 2px 0 0;
  position: relative;
  z-index: 10;
}

.hat:before {
  content: "";
  width: 100%;
  height: 6px;
  border-radius: 50%;
  background-color: rgb(31,33,43);
  position: absolute;
  top: -3px
}

.hat:after {
  content: "";
  width: 150%;
  height: 5px;
  background-color: rgb(31,33,43);
  position: absolute;
  bottom: -5px;
  left: -25%;
}

.head {
  width: 100px;
  height: 100px;
  background-color: rgb(246,208,166);
  border-radius: 50%;
  margin: 0 auto;
  z-index: 2;
  position: relative;
}

.head:after {
  content: "";
  position: absolute;
  top: 90px;
  left: 50%;
  margin-left: -15px;
  width: 30px;
  height: 40px;
  background-color: rgb(246,208,166);
}

.eyes {
  width: 25px;  
  height: 25px;
  background-color: white;
  position: absolute;
  top: 30px;
  border-radius: 50%;
}

.blink {
  width: 27px; 
  height: 27px;
  position: absolute;
  top: -25px;
  left: -1px;
  z-index: 2;
  border-radius: 0 0 10px 10px;
  background-color: rgb(246,208,166); 
  animation: blinks 5s ease-in-out 2s infinite;
}

@keyframes blinks {
  0% { top: -25px; }
  10% { top: 0px; }
  20% { top: -25px; }
}

.eyes.left {
  left: 20px;
}

.eyes.right {
  right: 20px;
}

.eyes:before { 
  content: "";
  position: absolute;
  width: 15px;
  height: 19px;
  top: 20%;
  left: 20%;
  background-color: black;
  border-radius: 50%;
}

.eyes:after { 
  content: "";
  position: absolute;
  width: 5px;
  height: 5px;
  top: 24%;
  left: 50%;
  background-color: white;
  border-radius: 50%;
}

.left.eyes:after {
  left: 19%
}

.right.eyes:after {
  left: 58%
}

.mouth {
  position: absolute;
  left: 50%;
  bottom: 10%;
  margin-left: -20px;
  background-color: black;
  width: 40px;
  height: 20px;
  border-radius: 10px 10px 70px 70px;
  overflow: hidden;
}

.mouth:before {
  content: "";
  height: 4px;
  width: 20px;
  background-color: white;
  position: absolute;
  top: 0;
  left: 10px;
  border-radius: 0px 0px 50px 50px;
}

.mouth:after {
  content: "";
  height: 6px;
  width: 20px;
  background-color: red;
  position: absolute;
  bottom: -2px;
  left: 10px;
  border-radius: 50px 50px 50px 50px;
}

.human .body {
  height: 170px;
  width: 100px;
  background-color: rgb(31,33,43);
  margin: 30px auto 0;
  position: relative;
  z-index: 2;
}
  
.human .bow {
  width: 20px;
  height: 20px;
  background-color: red;
  position: absolute; 
  top: -25px;
  left: 50%;
  margin-left: -10px;
  z-index: 3;
  border-radius: 50%;
}

.human .bow:before {
  content: "";
  position: absolute;
  right: 0%;
  top: 0px;
  width: 0; 
	height: 0; 
	border-top: 10px solid transparent;
	border-bottom: 10px solid transparent;
	
	border-left: 30px solid red;
}

.human .bow:after {
  content: "";
  position: absolute;
  left: 0%;
  top: 0px;
  width: 0; 
	height: 0; 
  width: 0; 
	height: 0; 
	border-top: 10px solid transparent;
	border-bottom: 10px solid transparent; 
	
	border-right: 30px solid red; 
}

.body .top {
  position: absolute;
  height: 80px;
  width: 120%;
  top: -20px;
  left: -10%;
  background-color: rgb(31,33,43);
  border-radius: 50%;
}

.body .side {
  position: absolute;
  top: 0px;
}

.body .left {
  height: 150px;
  width: 50%;
  background-color: rgb(31,33,43);
  left: -21px;
  border-radius: 50%;
}

.body .right {
  height: 150px;
  width: 50%;
  background-color: rgb(31,33,43);
  border-radius: 50%;
  right: -21px;
}

.human .body .shirt {
  height: 140px;
  margin: 0 auto;
  width: 30%;  
  background-color: white;
  position: absolute;
  left: 50%;
  top: -20px;
  margin-left: -15%;
}

.shirt:after {
  content:"";
  width: 100%;
  height: 20px;
  background-color: grey;
  display: block;
}

.buttons {
  width: 10px;
  height: 75%;
  margin: 30px auto 0;

}

.button {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background-color: black;
  margin-bottom: 35px
}


.legs {
  width: 100px;
  height: 80px;
  margin: 0 auto -10px;
}

.leg {
  width: 45%;
  height: 100%;
  display: inline-block;
  position: relative;
  z-index: 1;
  background-color: rgb(31,33,43);
}

.leg:after {
  content: "";
  position: absolute;
  z-index:0;
  bottom: -20px;
  width: 100%;
  height: 30px;
  background-color: #CB8B4D;
  border-radius: 50px 50px 5px 5px;
}

.leg.right {
  float: right; 
}

.ground {
  width: 100%;
  height: 100%;
  display: block;
  float: left;
  background-color: #7B6352;
  margin: 0;
}
</style>