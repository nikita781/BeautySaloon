<div class="container">
    <div class="callback">
        <div class="callback-container">
            <div class="callback_title">Свяжитесь с нами</div>
            <p><strong>Хотите стать лучше, но не знаете, с чего начать?</strong></p>
            <p>Регистрируйтесь или закажите звонок </p>
            <div class="callback_btn-container">
                <a href="reg.php" class="callback_btn">
                    Регистрация
                </a>
                <button class="callback_btn callback_btn-white openDialog">
                    Заказать звонок
                </button>
                <div class="dialog">
                    <div class="dialog__content">
                        <div class="dialog__title-cont">
                            <div class="dialog__title">Обратный звонок</div>
                            <img id="closeDialog" src="/assets/img/close.svg" alt="">
                        </div>
                        <form class="auvt__form" action="/controllers/add_callback.php" method="POST">
                            <input class="auvt__form-cont-input" type="text" name="name" placeholder="Ваше имя" required>
                            <input class="auvt__form-cont-input" type="number" name="phone" placeholder="Телефон" required>
                            <textarea class="auvt__form-cont-input auvt__form-cont-textarea" name="desc" placeholder="Сообщение" required></textarea>
                            <input class="auvt__form-submit" type="submit" name="add_user" value="Отправить" required>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <img class="callback-img" src="/assets/img/girls.png" alt="">
    </div>
</div>