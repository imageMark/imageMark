<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = '登录';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    canvas {
        background-color:#000000;
        position:absolute;
        top:0;
        left:0;
        bottom: 0;
    }
    .btn-study{
        background-color: #387EE8;color: #FFFFFF !important;
    }
    .login-box-body{border-radius: 5px;}
</style>
<body class="hold-transition login-page">
<canvas id="screen">

<!-- /.login-box -->
</canvas>
<div  style="position: fixed;z-index: 9999;left: calc(50% - 180px);width: 360px;margin: 7% auto;" >


    <!-- /.login-logo -->
    <div class="login-box-body" >

        <div class="box-header center-block" style="margin-bottom: 20px;display: flex;flex-direction: column;">
            <h3 class="box-title" style="color: #464646;font-size: 24px;text-align: center;">欧依安盾AI数据标注系统</h3>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'username',['inputTemplate' => '<div class="input-group"><span class="input-group-addon">
<i class="fa fa-user-o"></i>
</span>{input}</div>'])->textInput([
            'autofocus' => true,

            'placeholder'=>"请输入管理员账号"
        ])->label(false) ?>

        <?= $form->field($model, 'password',['inputTemplate' => '<div class="input-group"><span class="input-group-addon">
<i class="fa fa-lock"></i>
</span>{input}</div>'])->passwordInput(['placeholder'=>"请输入密码"])->label(false) ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton('进入', ['class' => 'btn btn-study', 'name' => 'login-button','style' => 'width:100%']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    <!-- /.login-box-body -->
</div>
<script>
    // Code by Matheus Lin
    // While developing a version of "Chain Reaction", I ended up on
    // those "fireworks-like" things. I leave it to you here.
    // Chain Reaction coming up next!

    // Configs

    var screenWidth = window.innerWidth;
    var screenHeight = window.innerHeight;

    var minVx = -10;
    var deltaVx = 20;
    var minVy = 25
    var deltaVy = 15;
    var minParticleV = 5;
    var deltaParticleV = 5;

    var gravity = 1;

    var explosionRadius = 200;
    var bombRadius = 10;
    var explodingDuration = 100;
    var explosionDividerFactor = 10; // I couldn't find a better name. Got any?

    var nBombs = 1; // initial
    var percentChanceNewBomb = 5;

    // Color utils forked from http://andreasstorm.com/
    // (or someone who forked from there)

    function Color(min) {
        min = min || 0;
        this.r = colorValue(min);
        this.g = colorValue(min);
        this.b = colorValue(min);
        this.style = createColorStyle(this.r, this.g, this.b);
    };

    function colorValue(min) {
        return Math.floor(Math.random() * 255 + min);
    }

    function createColorStyle(r,g,b) {
        return 'rgba(' + r + ',' + g + ',' + b + ', 0.8)';
    }

    // A Bomb. Or firework.
    function Bomb(){
        var self = this;

        self.radius = bombRadius;
        self.previousRadius = bombRadius;
        self.explodingDuration = explodingDuration;
        self.hasExploded = false;
        self.alive = true;
        self.color = new Color();

        self.px = (window.innerWidth / 4) + (Math.random() * window.innerWidth / 2);
        self.py = window.innerHeight;

        self.vx = minVx + Math.random() * deltaVx;
        self.vy = (minVy + Math.random() * deltaVy) * -1; // because y grows downwards

        self.duration =

            self.update = function(particlesVector){
                if(self.hasExploded){
                    var deltaRadius = explosionRadius - self.radius;
                    self.previousRadius = self.radius;
                    self.radius += deltaRadius / explosionDividerFactor;
                    self.explodingDuration--;
                    if(self.explodingDuration == 0){
                        self.alive = false;
                    }
                }
                else{
                    self.vx += 0;
                    self.vy += gravity;
                    if(self.vy >= 0){ // invertion point
                        self.explode(particlesVector);
                    }

                    self.px += self.vx;
                    self.py += self.vy;
                }
            };

        self.draw = function(ctx){
            ctx.beginPath();
            ctx.arc(self.px, self.py, self.previousRadius, 0, Math.PI * 2, false);
            if(self.hasExploded){
            }
            else{
                ctx.fillStyle = self.color.style;
                ctx.lineWidth = 1;
                ctx.fill();
            }

        };


        self.explode = function(particlesVector){
            self.hasExploded = true;
            var e = 3 + Math.floor(Math.random() * 3);
            for(var j = 0; j < e; j++){
                var n = 10 + Math.floor(Math.random() * 21); // 10 - 30
                var speed = minParticleV + Math.random() * deltaParticleV;
                var deltaAngle = 2 * Math.PI / n;
                var initialAngle = Math.random() * deltaAngle;
                for(var i = 0; i < n; i++){
                    particlesVector.push(new Particle(self,  i * deltaAngle + initialAngle, speed));
                }
            }
        };

    }

    function Particle(parent, angle, speed){
        var self = this;
        self.px = parent.px;
        self.py = parent.py;
        self.vx = Math.cos(angle) * speed;
        self.vy = Math.sin(angle) * speed;
        self.color = parent.color;
        self.duration = 40 + Math.floor(Math.random()*20);
        self.alive = true;

        self.update = function(){
            self.vx += 0;
            self.vy += gravity / 10;

            self.px += self.vx;
            self.py += self.vy;
            self.radius = 3;

            self.duration--;
            if(self.duration <= 0){
                self.alive = false;
            }
        };

        self.draw = function(ctx){
            ctx.beginPath();
            ctx.arc(self.px, self.py, self.radius, 0, Math.PI * 2, false);
            ctx.fillStyle = self.color.style;
            ctx.lineWidth = 1;
            ctx.fill();
        };

    }

    function Controller(){
        var self = this;
        self.canvas = document.getElementById("screen");
        self.canvas.width = screenWidth;
        self.canvas.height = screenHeight;
        self.ctx = self.canvas.getContext('2d');

        function setSpeedParams(){
            var heightReached = 0;
            var vy = 0;

            while(heightReached < screenHeight && vy >= 0){
                vy += gravity;
                heightReached += vy;
            }

            minVy = vy / 2;
            deltaVy = vy - minVy;

            vx = (1 / 4) * screenWidth / (vy / 2);
            minVx = -vx;
            deltaVx = 2*vx;
        };



        self.resize = function(){
            screenWidth = window.innerWidth;
            screenHeight = window.innerHeight;
            self.canvas.width = screenWidth;
            self.canvas.height = screenHeight;
            setSpeedParams();
        };
        self.resize();

        window.onresize = self.resize;

        self.init = function(){
            self.readyBombs = [];
            self.explodedBombs = [];
            self.particles = [];

            for(var i = 0; i < nBombs; i++){
                self.readyBombs.push(new Bomb());
            }
        }

        self.update = function(){
            var aliveBombs = [];
            while(self.explodedBombs.length > 0){
                var bomb = self.explodedBombs.shift();
                bomb.update();
                if(bomb.alive){
                    aliveBombs.push(bomb);
                }
            }
            self.explodedBombs = aliveBombs;

            var notExplodedBombs = [];
            while(self.readyBombs.length > 0){
                var bomb = self.readyBombs.shift();
                bomb.update(self.particles);
                if(bomb.hasExploded){
                    self.explodedBombs.push(bomb);
                }
                else{
                    notExplodedBombs.push(bomb);
                }
            }
            self.readyBombs = notExplodedBombs;

            var aliveParticles = [];
            while(self.particles.length > 0){
                var particle = self.particles.shift();
                particle.update();
                if(particle.alive){
                    aliveParticles.push(particle);
                }
            }
            self.particles = aliveParticles;
        }

        self.draw = function(){
            self.ctx.beginPath();
            self.ctx.fillStyle='rgba(0, 0, 0, 0.1)'; // Ghostly effect
            self.ctx.fillRect(0, 0, self.canvas.width, self.canvas.height);



            for(var i = 0; i < self.readyBombs.length; i++){
                self.readyBombs[i].draw(self.ctx);
            }

            for(var i = 0; i < self.explodedBombs.length; i++){
                self.explodedBombs[i].draw(self.ctx);
            }

            for(var i = 0; i < self.particles.length; i++){
                self.particles[i].draw(self.ctx);
            }

        }

        self.animation = function(){
            self.update();
            self.draw();

            if(Math.random() * 100 < percentChanceNewBomb) {
                self.readyBombs.push(new Bomb());
            }


            requestAnimationFrame(self.animation);
        }
    }

    var controller = new Controller();
    controller.init();
    requestAnimationFrame(controller.animation);
</script>

