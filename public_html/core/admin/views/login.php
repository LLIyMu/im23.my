<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?=PATH.ADMIN_TEMPLATE?>authstyle/style.css">
    <title>Страница авторизации</title>
    <style>
        html, body{
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            font-family: Roboto, serif;
        }
        body{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        div{
            padding: 15px;
        }
        form{
            display: block;
        }
        label, input{
            display: block;
            margin: auto;
            color: darkgreen;
        }
        label, h1{
            text-align: center;
            margin-bottom: 5px;
        }
        input{
            margin-bottom: 20px;
            padding: 3px 5px;
            border-radius: 10px;
        }
        input[type=submit]{
            background: #fffaea;
            padding: 10px 20px;
            border: solid 1px black;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div>
        <?php if(!empty($_SESSION['res']['answer'])):?>
            <p style="color:red"><?=$_SESSION['res']['answer']?></p>
        <?php endif;?>
        <h1 style="color: darkred">Авторизация</h1>

        <form method="post" action="<?=PATH.$adminPath?>/login">
            <label for="login">Имя пользователя</label>
            <input type="text" name="login">
            <label for="password">Пароль</label>
            <input type="password" name="password">
            <input type="submit" name="submit" value="Войти">
        </form>
    </div>

<div class="vg_modal vg-center">
    <?php
    if(isset($_SESSION['res']['answer'])){
        unset($_SESSION['res']);
    }
    ?>
</div>

    <script src="<?=PATH . ADMIN_TEMPLATE?>js/framework_functions.js"></script>
    <script>
        let form = document.querySelector('form')

        if (form){
            form.addEventListener('submit', e => {

                if (e.isTrusted){

                    e.preventDefault()

                    Ajax({data:{ajax:'token'}}).then(res => {

                        if (res){

                            form.insertAdjacentHTML('beforeend', `<input type="hidden" name="token" value="${res}">`);

                        }
                        form.dispatchEvent(new Event('submit'));
                        //form.submit()

                    })
                }
            })
        }
    </script>
</body>
</html>