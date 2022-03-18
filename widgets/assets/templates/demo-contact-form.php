<div class="obpress-contact-form-holder">

    <form class="obpress-contact-form" data-hotel-folders="<?php echo htmlspecialchars(json_encode($hotelFolders), ENT_QUOTES, 'UTF-8'); ?>">

        <h2 class="obpress-contact-form-title"><?php _e('Contact us', 'OBPress_Contact_Form') ?></h2>

        <div class="obpress-input-holder">
            <input type="text" name="name" placeholder="<?php _e('Name', 'OBPress_Contact_Form') ?>" class="name-input">
            <span id="obpress-contact-form-name-warning"><?php _e('Enter your name', 'OBPress_Contact_Form') ?></span>
        </div>

        <div class="obpress-input-holder obpress-input-split-holder">

            <div>
                <input type="email" name="email" placeholder="<?php _e('Email', 'OBPress_Contact_Form') ?>" class="email-input">
                <span id="obpress-contact-form-email-warning"><?php _e('Email is incorrect', 'OBPress_Contact_Form') ?></span>
            </div>

            <div>
                <input type="tel" name="phone" placeholder="<?php _e('Phone', 'OBPress_Contact_Form') ?>" class="phone-input" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                <span id="obpress-contact-form-phone-warning"><?php _e('Enter your phone', 'OBPress_Contact_Form') ?></span>
            </div>

        </div>

        <div class="obpress-input-holder">

            <input type="text" id="hotels" spellcheck="false" autocomplete="off" placeholder="<?php _e('Hotel', 'OBPress_Contact_Form') ?>" class="hotel-input">
            <div class="hotels_dropdown">
                <div class="hotels_hotel custom-bg custom-text" data-id="" hidden></div>
            </div>

        </div>

        <div class="obpress-input-holder">
            <textarea id="message" name="message" rows="10" placeholder="<?php _e('Message', 'OBPress_Contact_Form') ?>" class="message-input"></textarea>
            <span id="obpress-contact-form-message-warning"><?php _e('Enter your message', 'OBPress_Contact_Form') ?></span>
        </div>

        <button class="obpress-contact-submit" type="submit"><?php _e('Submit', 'OBPress_Contact_Form') ?></button>
        <span id="obpress-contact-form-success"><?php _e('Your message has been succesfully sent', 'OBPress_Contact_Form') ?></span>

    </form>
</div>





