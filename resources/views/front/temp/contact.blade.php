<section id="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <!-- Section-title -->
                <div class="section-title"><h3>اطلاعات<strong>تماس</strong></h3>
{{--                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک--}}
{{--                        است. </p>--}}
                </div>
                <!--/ section-title -->
                <!-- Contacts Info -->
                <div class="contacts-info">
                    <ul class="list-unstyled info">
                        <li><i class="fas fa-phone"></i><span> 021-88820011-13</span></li>
                        <li><i class="fas fa-envelope"></i><span>info@parsproshat.com</span></li>
                        <li><i class="fas fa-map-marker-alt"></i><span>تهران - خیابان مطهری - خیابان فجر - بن بست مدائن پلاک 1 واحد همکف </span></li>
                    </ul>
                    <!-- Social Media Links -->
                    <ul class="socialMediaLinks list-inline main-style">
                        <li class="list-inline-item"><a target="_blank" href="https://www.instagram.com/parsproshat"><i class="fab fa-instagram"> </i></a></li>
                        <li class="list-inline-item"><a  target="_blank" href="https://t.me/parsproshat"><i class="fab fa-telegram"> </i></a></li>
                        <li class="list-inline-item"><a  target="_blank" href="https://t.me/PARSANDISHANPROSHAT"><i class="fab fa-telegram"> </i></a></li>

                    </ul>
                    <!-- ./ Social Media Links -->
                </div><!-- / Contacts Info -->
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <!-- Contact Form -->
                <div class="contact-form">

                    <form class="needs-validation form" method="get" novalidate
                          action="/message/contact">
                        <!-- Name -->
                        <div class="form-group">
                            <div class="input-group"><input class="form-control" id="name" name="name" type="text"
                                                            placeholder="نام ونام خانوادگی" required>
                                <div class="input-group-append"><span class="input-group-text fas fa-user"></span>
                                </div>
                                <div class="invalid-tooltip">نام و نام خانوادگی خود را وارد کنید.</div>
                            </div>
                        </div>
                        <!-- / Name -->
                        <!--  Phone -->
                        <div class="form-group">
                            <div class="input-group"><input class="form-control" id="phone" name="mobile" type="text"
                                                            placeholder="تلفن تماس" required>
                                <div class="input-group-append"><span class="input-group-text fas fa-phone"></span>
                                </div>
                                <div class="invalid-tooltip">تلفن تماس خود را وارد کنید.</div>
                            </div>
                        </div>
                        <!--  /Phone -->
                        <!--  Email -->
                        <div class="form-group">
                            <div class="input-group"><input class="form-control" id="email" name="email"
                                                            type="email" placeholder="ایمیل"
                                                            >
                                <div class="input-group-append"><span
                                        class="input-group-text fas fa-envelope"></span></div>
                                <div class="invalid-tooltip">ایمیل خود را وارد کنید.</div>
                            </div>
                        </div>
                        <!--  / Email -->
                        <!--  Message -->
                        <div class="form-group"><textarea class="form-control" id="message" name="message"
                                                          placeholder="پیام" rows="4"
                                                          required></textarea>
                            <div class="invalid-tooltip">پیام خود را وارد کنید.</div>
                        </div>
                        {{csrf_field()}}
                        <!--  /Message -->
                        <!--  Submit Button  -->
                        <button class="btn-gradient" type="submit"><i
                                class="fab fa-telegram-plane"> </i><span>ارسال</span></button>
                        <!-- / Submit Button  -->
                    </form>

                    <div class="form-messages">
                        <div class="alert"></div>
                    </div>
                </div>
                <!-- / Contact Form -->
            </div>
        </div>
    </div>
</section>
