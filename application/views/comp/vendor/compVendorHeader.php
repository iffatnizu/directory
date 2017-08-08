<header id=header> 
    <span class="logo">
        Directory <br/>
        Vendor Panel
    </span>
    <article id="headerright">

        <?php
        if ($this->session->userdata('_userLogin')) {
            ?>

            <div id=user-info>
                <p> 
                    <span class=messages>Hello <a href="javascript:void(0);"><?php echo $this->session->userdata('_userName'); ?></a></span>                    
                </p>
            </div>
            <?php
        }
        ?>

    </article>
</header>

