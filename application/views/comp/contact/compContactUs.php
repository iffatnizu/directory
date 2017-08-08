<div class="commonpages">
    <div>
        <h2><i class="icon-coffee"></i> <?php echo $title ?> ...</h2>
        <div>
            <img width="128" src="<?php echo base_url() ?>assets/images/Tea-Cup-icon.png" alt="contact" style="float: left;"/>

            <?php
            echo $content[DBConfig::TABLE_CONTENT_ATT_CONTENT_DETAILS]
            ?>
        </div>
        <br clear="all"/>
        <section id="business-query">										

            <form enctype="multipart/form-data" id="business-query-form" class="form-a" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

                <?php
                if ($this->session->userdata('success')) {
                    ?>
                <h3 class="btn-success" style="text-indent: 35px;">Your query successfully sent</h3>
                    <?php
                }
                $s['success'] = FALSE;
                $this->session->unset_userdata($s);
                ?>
                <fieldset>								
                    <div class="hbox-d">									
                        <h2 class="header-e">Main information</h2>
                        <div class="helper-b">Fields with * are mandatory</div>
                    </div><!-- .hbox-d -->

                    <br clear="all"/>

                    <div class="fgroup-a">
                        <div class="field-a">
                            <label for="fl_name">First and last name *</label>
                            <span class="focus-wrapper">
                                <input type="text" class="name" id="fl_name" value="<?php echo set_value('name'); ?>" name="name"/>
                                <small class="error"><?php echo form_error('name'); ?></small>
                            </span>
                        </div>
                        <div class="field-a fl-a">
                            <label for="email">Email *</label>
                            <span class="focus-wrapper">
                                <input type="text" class="email" id="email" value="<?php echo set_value('email'); ?>" name="email"/>
                                <small class="error"><?php echo form_error('email'); ?></small>
                            </span>
                        </div>
                    </div><!-- .fgroup-a -->

                    <div class="fgroup-a">
                        <div class="field-a">
                            <label for="company">Company name</label>
                            <span class="focus-wrapper"><input type="text" class="company" id="company" value="" name="company"/></span>
                        </div>
                        <div class="field-a fl-a">
                            <label for="phone">Phone</label>
                            <span class="focus-wrapper"><input type="tel" class="phone" id="phone" value="" name="phone"/></span>
                        </div>
                    </div><!-- .fgroup-a -->								
                </fieldset>

                <fieldset class="fdset-a">
                    <div class="hbox-d">									
                        <h2 class="header-e">Additional information</h2>										
                    </div><!-- .hbox-d -->

                    <div class="fgroup-a">
                        <div class="field-a">
                            <label for="project-start">When do You want to start project?</label>
                            <select id="project-start" name="project-start">
                                <option value="">- choose -</option>
                                <option value="w ciągu tygodnia">within a week</option>
                                <option value="w ciągu 2 tygodni">within two weeks</option>
                                <option value="za miesiąc">per month</option>
                                <option value="termin do uzgodnienia">date to be agreed</option>
                            </select>
                        </div>
                        <div class="field-a fl-a">
                            <label for="work-span">Scope of work</label>
                            <select id="work-span" name="work-span">
                                <option data-set="0" value="">- choose -</option>
                                <option data-set="1" value="wszystko">Design + programming (with cms)</option>
                                <option data-set="1" value="wszystko e-commerce">Design + programming (e-commerce)</option>
                                <option data-set="1" value="wszystko bez cms">Design + programming (without cms)</option>
                                <option data-set="1" value="design+psd2html">Design + psd2html (templates (X)HTML/CSS/JS)</option>
                                <option data-set="3" value="tylko projekt">Design only</option>
                                <option data-set="2" value="tylko psd2html">Psd2html only (templates (X)HTML/CSS/JS)</option>
                                <option data-set="1" value="inne">Other (please describe it in details below)</option>
                            </select>									
                        </div>										
                    </div><!-- .fgroup-a -->
                </fieldset>



                <fieldset>								
                    <div class="hbox-d">									
                        <h2 class="header-e">Your description</h2>										
                    </div><!-- .hbox-d -->									

                    <div class="fgroup-a">															
                        <div class="field-a fl-b">
                            <label for="message">Describe in few words most important features of the project *</label>
                            <span class="focus-wrapper">
                                <textarea class="message" cols="40" rows="8" id="message" name="message"><?php echo set_value('message'); ?></textarea>
                                <small class="error"><?php echo form_error('message'); ?></small>
                            </span>
                        </div>
                    </div>
                </fieldset>
                <button name="submitcontact" type="submit" class="btn btn-large btn-success"><span>Send</span></button>	

            </form>								
        </section>
    </div>
</div>