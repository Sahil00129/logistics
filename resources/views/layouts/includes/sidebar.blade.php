<!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">
            <?php
                $url = URL::to('/');
                $string = request()->route()->getPrefix();
                $getprefix = str_replace('/', '', $string);
                $segment   = Request::segment(2);
                $prefixurl = $url.$getprefix.'/';
                $authuser = Auth::user();
                $permissions = App\Models\UserPermission::where('user_id',$authuser->id)->pluck('permisssion_id')->ToArray();
                $submenusegment = Request::segment(3);
            ?>
            <nav id="sidebar">
                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu">
                        <a href="{{$prefixurl.'dashboard'}}" data-active="true" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu">
                        <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span>Users</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="users" data-parent="#accordionExample">
                            <li>
                                <a href="{{$prefixurl.'users'}}"> All Users </a>
                            </li>
                            <li>
                                <a href="{{$prefixurl.'roles'}}"> All Roles </a>
                            </li>
                            <li>
                                <a href="{{$prefixurl.'permissions'}}"> All Permissions </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu">
                        <a href="{{$prefixurl.'branches'}}" data-active="" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Branches</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu">
                        <a href="{{$prefixurl.'consigners'}}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span>Consigners</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu">
                        <a href="{{$prefixurl.'consignees'}}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span>Consignee</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu">
                        <a href="{{$prefixurl.'agents'}}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span>Agents</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu">
                        <a href="{{$prefixurl.'drivers'}}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span>Drivers</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu">
                        <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                <span>Forms</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="form_bootstrap_basic.html"> Basic </a>
                            </li>
                            <li>
                                <a href="form_input_group_basic.html"> Input Group </a>
                            </li>
                            <li>
                                <a href="form_layouts.html"> Layouts </a>
                            </li>
                            <li>
                                <a href="form_validation.html"> Validation </a>
                            </li>
                            <li>
                                <a href="form_input_mask.html"> Input Mask </a>
                            </li>
                            <li>
                                <a href="form_bootstrap_select.html"> Bootstrap Select </a>
                            </li>
                            <li>
                                <a href="form_select2.html"> Select2 </a>
                            </li>
                            <li>
                                <a href="form_bootstrap_touchspin.html"> TouchSpin </a>
                            </li>
                            <li>
                                <a href="form_maxlength.html"> Maxlength </a>
                            </li>                          
                            <li>
                                <a href="form_checkbox_radio.html"> Checkbox &amp; Radio </a>
                            </li>                            
                            <li>
                                <a href="form_switches.html"> Switches </a>
                            </li>
                            <li>
                                <a href="form_wizard.html"> Wizards </a>
                            </li>
                            <li>
                                <a href="form_fileupload.html"> File Upload </a>
                            </li>
                            <li>
                                <a href="form_quill.html"> Quill Editor </a>
                            </li>
                            <li>
                                <a href="form_markdown.html"> Markdown Editor </a>
                            </li>
                            <li>
                                <a href="form_date_range_picker.html"> Date &amp; Range Picker </a>
                            </li>
                            <li>
                                <a href="form_clipboard.html"> Clipboard </a>
                            </li>
                            <li>
                                <a href="form_typeahead.html"> Typeahead </a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
                
            </nav>

        </div>
        <!--  END SIDEBAR  -->