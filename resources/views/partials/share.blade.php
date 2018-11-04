<div class="app-partial-share">
    <social-sharing
            inline-template quote="Quote here"
            url="{{ url()->current() }}"
            title="Title here"
            description="Description here"
            quote="See more quote"
            hashtags="art,tags,hashtags"
            twitter-user="twitterUserTest">
        <div class="share">
            <network network="facebook" class="facebook">
                <i class="icon-facebook"></i>
            </network>

            <network network="googleplus"
                     class="google">
                <i class="icon-google"></i>
            </network>

            <network network="twitter" class="twitter">
                <i class="icon-twitter"></i>
            </network>

            <network network="linkedin" class="linkedin">
                <i class="icon-linkedin"></i>
            </network>

            <network network="email" class="email">
                <i class="el-icon-message"></i>
            </network>
        </div>
    </social-sharing>
</div>