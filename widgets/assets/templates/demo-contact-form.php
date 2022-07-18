<div class="obpress-contact-form-holder">

    <form class="obpress-contact-form" data-hotel-folders="<?php echo htmlspecialchars(json_encode($hotelFolders), ENT_QUOTES, 'UTF-8'); ?>">

        <!-- <div class="obpress-input-holder">
            <input type="text" name="name" placeholder="<?php _e('Name', 'OBPress_Contact_Form') ?>" class="name-input">
            <span id="obpress-contact-form-name-warning"><?php _e('Enter your name', 'OBPress_Contact_Form') ?></span>
        </div> -->


        <div class="personal-box_info first-name obpress-input-holder">
            <div class="material-textfield">
                <input placeholder=" " type="text" class="form-control lock-i locked-input btn-ic name-input" id="input-name" name="name" maxlength="100" required autocomplete="on">
                <label class="label-title">
                    <span class="red-asterix">*</span>
                    <?php _e('Name', 'OBPress_Contact_Form') ?>
                </label>
                <span class="obpress-erorr-holder" id="obpress-contact-form-name-warning"><?php _e('Enter your name', 'OBPress_Contact_Form') ?></span>
            </div>
        </div>

        <div class="obpress-input-holder obpress-input-split-holder">

            <!-- <div>
                <input type="email" name="email" placeholder="<?php _e('Email', 'OBPress_Contact_Form') ?>" class="email-input">
                <span id="obpress-contact-form-email-warning"><?php _e('Email is incorrect', 'OBPress_Contact_Form') ?></span>
            </div> -->

            <div class="personal-box_info email-box">
                <div class="material-textfield">
                    <input placeholder=" " type="email" class="form-control btn-ic email-input" id="input-email" name="email" maxlength="100" autocomplete="off" required>
                    <label class="label-title">
                        <span class="red-asterix">*</span>
                        <?php _e('Email', 'OBPress_Contact_Form') ?>
                    </label>
                    <span class="obpress-erorr-holder" id="obpress-contact-form-email-warning"><?php _e('Email is incorrect', 'OBPress_Contact_Form') ?></span>
                </div>
            </div>

            <!-- <div>
                <input type="tel" name="phone" placeholder="<?php _e('Phone', 'OBPress_Contact_Form') ?>" class="phone-input" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                <span id="obpress-contact-form-phone-warning"><?php _e('Enter your phone', 'OBPress_Contact_Form') ?></span>
            </div> -->

            <div class="personal-box_info email-box">
                <div class="material-textfield">
                    <input placeholder=" " type="tel" class="form-control btn-ic phone-input" id="input-phone" name="phone" maxlength="100" autocomplete="off" required onkeyup="if (/[^0-9\+]/g.test(this.value)) this.value = this.value.replace(/[^0-9\+]/g,'')">
                    <label class="label-title">
                        <span class="red-asterix">*</span>
                        <?php _e('Phone', 'OBPress_Contact_Form') ?>
                    </label>
                    <span class="obpress-erorr-holder" id="obpress-contact-form-phone-warning"><?php _e('Enter your phone', 'OBPress_Contact_Form') ?></span>
                </div>
            </div>

        </div>

        <div class="obpress-input-holder">

            <div class="material-textfield">
                <input placeholder=" " class="hotel-input" id="hotels" spellcheck="false" type="text" required="" autocomplete="off">
                <label class="label-title">
                    <?php _e('Hotel', 'OBPress_Contact_Form') ?>
                </label>
            </div>

            <!-- <input type="text" id="hotels" spellcheck="false" autocomplete="off" placeholder="<?php _e('Hotel', 'OBPress_Contact_Form') ?>" class="hotel-input"> -->
            <div class="hotels_dropdown">
                <div class="hotels_hotel custom-bg custom-text" data-id="" hidden></div>
            </div>

        </div>

        <div class="obpress-input-holder material-textfield">
            <textarea id="message" name="message" rows="10" placeholder="<?php _e('Message', 'OBPress_Contact_Form') ?>" class="message-input"></textarea>
            <span class="obpress-erorr-holder" id="obpress-contact-form-message-warning"><?php _e('Enter your message', 'OBPress_Contact_Form') ?></span>
        </div>

        <button class="obpress-contact-submit <?= $settings['custom_button_width']; ?>" type="submit" disabled><?php _e('Submit', 'OBPress_Contact_Form') ?></button>
        <span id="obpress-contact-form-success"><?php _e('Your message has been successfully sent', 'OBPress_Contact_Form') ?></span>

    </form>
</div>





