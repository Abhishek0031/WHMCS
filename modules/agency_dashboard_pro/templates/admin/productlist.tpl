
{include file=$tplVar.header}

<div class="lisence-verify-wrapper">
        
    <div class="modulte-tabs-wrapper">
            <div class="module-tab-box">
                <div class="module-nav-tab">
                    <ul class="promenu">
                        
                        {foreach from=$tplVar['tplProductList'] item=item}
                            <li class="module-nav-item" id ='{$item->id}' data-type='{$item->type}' data-module-name='{$item->module_name}'>
                                <a href="">
                                    <span>
                                        <!-- <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_154_3085)">
                                        <rect width="16" height="16" fill="#F8F9FA"></rect>
                                        <path d="M14.7069 0H9.9672C9.25302 0 8.67407 0.578952 8.67407 1.29313V6.03281C8.67407 6.74699 9.25302 7.32594 9.9672 7.32594H14.7069C15.4211 7.32594 16 6.74699 16 6.03281V1.29313C16 0.578952 15.4211 0 14.7069 0Z" fill="CurrentColor"></path>
                                        <path d="M6.03281 0H1.29313C0.578952 0 0 0.578952 0 1.29313V6.03281C0 6.74699 0.578952 7.32594 1.29313 7.32594H6.03281C6.74699 7.32594 7.32594 6.74699 7.32594 6.03281V1.29313C7.32594 0.578952 6.74699 0 6.03281 0Z" fill="CurrentColor"></path>
                                        <path d="M14.7069 8.67406H9.9672C9.25302 8.67406 8.67407 9.25302 8.67407 9.96719V14.7069C8.67407 15.4211 9.25302 16 9.9672 16H14.7069C15.4211 16 16 15.4211 16 14.7069V9.96719C16 9.25302 15.4211 8.67406 14.7069 8.67406Z" fill="CurrentColor"></path>
                                        <path d="M6.03281 8.67406H1.29313C0.578952 8.67406 0 9.25302 0 9.96719V14.7069C0 15.4211 0.578952 16 1.29313 16H6.03281C6.74699 16 7.32594 15.4211 7.32594 14.7069V9.96719C7.32594 9.25302 6.74699 8.67406 6.03281 8.67406Z" fill="CurrentColor"></path>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_154_3085">
                                        <rect width="16" height="16" fill="white"></rect>
                                        </clipPath>
                                        </defs>
                                        </svg> -->
                                        <svg enable-background="new 0 0 520 520" height="32" viewBox="0 0 520 520" width="32" xmlns="http://www.w3.org/2000/svg"><g id="_x32_93_x2C__3d_x2C__box_x2C__cube"><g><g><path d="m455 116.64c13.81 0 25 11.19 25 25 0 13.811-11.19 25-25 25s-25-11.189-25-25c0-13.81 11.19-25 25-25z" fill="#74829c"/><path d="m460 426.64c5.52 0 10 4.48 10 10s-4.48 10-10 10-10-4.48-10-10 4.48-10 10-10z" fill="#74829c"/><path d="m401.83 248.13-48.17-29.25h-.01l-14.62 8.89-33.55 20.379-28.04 17.021-20.13 12.229v58.491 58.519l48.18 29.261 48.17 29.25 48.17-29.25 48.17-29.261v-58.519-58.491z" fill="#4ec6bd"/><path d="m450 335.89v58.519l-48.17 29.261-48.17 29.25v-117.03l96.34-58.491z" fill="#41afa4"/><path d="m450 277.399-96.34 58.491-96.35-58.491 20.13-12.229 28.04-17.021 33.55-20.379 14.62-8.89h.01l48.17 29.25z" fill="#64e1db"/><path d="m400 66.64c5.52 0 10 4.48 10 10 0 5.521-4.48 10-10 10s-10-4.479-10-10c0-5.52 4.48-10 10-10z" fill="#74829c"/><path d="m353.66 335.89v117.03l-48.17-29.25-48.18-29.261v-58.519-58.491z" fill="#4ec6bd"/><path d="m305.48 72.61-48.17-29.25-48.16 29.25-48.19 29.26v58.5 58.51h.01l48.17 29.25 28.04 17.04 20.13 12.22 20.13-12.22 28.05-17.04 33.54-20.36 14.62-8.89v-58.51-58.5z" fill="#469be0"/><path d="m353.65 218.88-14.62 8.89-33.54 20.36-28.05 17.04-20.13 12.22v-117.02l96.34-58.5v58.5z" fill="#348bc6"/><path d="m353.65 101.87-96.34 58.5-96.35-58.5 48.19-29.26 48.16-29.25 48.17 29.25z" fill="#65b2fe"/><path d="m270 446.64c5.52 0 10 4.48 10 10s-4.48 10-10 10-10-4.48-10-10 4.48-10 10-10z" fill="#74829c"/><path d="m237.18 265.17-28.03-17.021-48.18-29.269h-.01l-48.16 29.25-48.19 29.269v58.491 58.519l48.19 29.261 48.17 29.25 48.17-29.25 48.17-29.261v-58.519-58.491z" fill="#e2b23b"/><path d="m257.31 335.89v58.519l-48.17 29.261-48.17 29.25v-117.03l96.34-58.491z" fill="#d19d18"/><path d="m257.31 160.37v117.02l-20.13-12.22-28.04-17.04-48.17-29.25h-.01v-58.51-58.5z" fill="#469be0"/><path d="m257.31 277.399-96.34 58.491-96.36-58.491 48.19-29.269 48.16-29.25h.01l48.18 29.269 28.03 17.021z" fill="#ffd24d"/><path d="m160.97 335.89v117.03l-48.17-29.25-48.19-29.261v-58.519-58.491z" fill="#e2b23b"/><g fill="#74829c"><path d="m100 446.64c5.52 0 10 4.48 10 10s-4.48 10-10 10-10-4.48-10-10 4.48-10 10-10z"/><path d="m80 46.64c11.05 0 20 8.95 20 20s-8.95 20-20 20-20-8.95-20-20 8.95-20 20-20z"/><path d="m80 126.64c5.52 0 10 4.48 10 10 0 5.521-4.48 10-10 10s-10-4.479-10-10c0-5.52 4.48-10 10-10z"/><path d="m50 456.64c5.52 0 10 4.48 10 10s-4.48 10-10 10-10-4.48-10-10 4.48-10 10-10z"/></g></g></g></g></svg>  
                                    </span>
                                    {$item->name|ucfirst}
                                </a>
                            </li>
                        {/foreach}
                       
                    </ul>
                </div>
                <div class="appendProduct module-nav-Content">
                    
                </div>
                <!-- <div class="module-nav-Content">
                    <div class="proloader-wrapper">
                        <div class="proloader"></div>
                    </div>
                    <div class="module-tab-pane">
                        <div class="module-heading-bx">
                            <h3>Configuration</h3>
                            <p>A&nbsp;dashboard&nbsp;is a web page that contains&nbsp;modules&nbsp;at various positions.</p>
                        </div>
                        <form class="module-form">
                            <div class="module-form-bx">
                                <div class="module-form-field">
                                    <label>Product Name</label>
                                    <input type="text" placeholder="Enter Product Name" class="lisence-input">
                                </div>
                                <div class="module-form-field">
                                    <label>Product Name</label>
                                    <input type="text" placeholder="Enter Product Name" class="lisence-input">
                                </div>
                                <div class="module-form-field">
                                    <label>Select Product</label>
                                    <select name="Select Product" id="Select Product" class="lisence-input">
                                        <option value="Product1">Product1</option>
                                    </select>
                                    
                                </div>
                                <div class="module-form-field">
                                    <label>Select Product</label>
                                    <select name="Select Product" id="Select Product" class="lisence-input">
                                        <option value="Product1">Product1</option>
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="module-checkbox">
                            <input type="checkbox" id="verify-product"><label for="verify-product">Verify Product</label>
                            </div>
                            <div class="module-radio-wrapper">
                                <div class="radio-box">
                                    <input id="product-enable&quot;" name="radio" type="radio" checked="">
                                    <label for="product-enable&quot;" class="radio-label">Product Enable</label>
                                </div>
                                
                                <div class="radio-box">
                                    <input id="product-disable" name="radio" type="radio">
                                    <label for="product-disable" class="radio-label">Product Disable</label>
                                </div>
                                </div>
                                <button class="lisence-button">save</button>
                        </form>
                    </div>
                </div> -->
        </div>
    </div>
</div>