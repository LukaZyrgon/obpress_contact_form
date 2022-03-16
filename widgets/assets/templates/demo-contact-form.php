<div class="obpress-contact-form-holder">
    <form class="obpress-contact-form" data-hotel-folders="<?php echo htmlspecialchars(json_encode($hotelFolders), ENT_QUOTES, 'UTF-8'); ?>">
        <div class="obpress-input-holder">
            <input type="text" name="name" placeholder="<?php _e('Name', 'OBPress_Contact_Form') ?>" class="name-input">
        </div>
        <div class="obpress-input-holder obpress-input-split-holder">
            <input type="email" name="email" placeholder="<?php _e('Email', 'OBPress_Contact_Form') ?>" class="email-input">
            <input type="tel" name="phone" placeholder="<?php _e('Phone', 'OBPress_Contact_Form') ?>" class="phone-input" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
        </div>
        <div class="obpress-input-holder">
            <input type="text" id="hotels" spellcheck="false" autocomplete="off" placeholder="<?php _e('Hotel', 'OBPress_Contact_Form') ?>" class="hotel-input">
            <div class="hotels_dropdown">
                <!-- <div class="hotels_all custom-bg custom-text" data-id="0"><?php _e('All Hotels', 'OBPress_Contact_Form') ?></div> -->
                <!-- <div class="hotels_folder custom-bg custom-text" hidden></div> -->
                <div class="hotels_hotel custom-bg custom-text" data-id="" hidden></div>
            </div>
        </div>
        <div class="obpress-input-holder">
            <textarea id="message" name="message" rows="10" placeholder="<?php _e('Message', 'OBPress_Contact_Form') ?>" class="message-input"></textarea>
        </div>
        <button class="obpress-contact-submit" type="submit"><?php _e('Submit', 'OBPress_Contact_Form') ?></button>
    </form>
</div>
