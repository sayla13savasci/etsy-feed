<?php
$shipping_infos = [];
$shipping_template_id = [];
$shipping_infos = get_option('shipping_template_infos');

if(!empty($shipping_infos)){
    foreach ($shipping_infos as $key => $val) {
        $shipping_template_id[] = $val['shipping_template_id'];
    }

}

?>

<div class="rex-etsy-api-setting__tab-wrapper">
    <ul class="rex-etsy-api-setting__tabs-area">
        <li class="tab-link settings active" data-tab="tab1">

            <svg id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512"
                 xmlns="http://www.w3.org/2000/svg">
                <g>
                    <path d="m453.741 319.08v-126.16c17.459-6.192 30-22.865 30-42.42 0-24.813-20.187-45-45-45-11.143 0-21.346 4.08-29.214 10.813l-109.283-63.095c.494-2.667.766-5.411.766-8.218 0-24.813-20.187-45-45-45s-45 20.187-45 45c0 2.808.271 5.552.766 8.218l-109.284 63.095c-7.868-6.733-18.07-10.813-29.214-10.813-24.813 0-45 20.187-45 45 0 19.555 12.541 36.228 30 42.42v126.163c-2.557.905-5.069 2.043-7.5 3.447-10.41 6.01-17.855 15.714-20.967 27.324-3.111 11.61-1.514 23.737 4.496 34.146 8.326 14.421 23.481 22.491 39.046 22.491 7.628-.001 15.356-1.939 22.424-6.021 2.432-1.404 4.672-3.011 6.734-4.772l109.263 63.083c-.494 2.667-.766 5.411-.766 8.218 0 24.813 20.187 45 45 45s45-20.187 45-45c0-2.808-.271-5.552-.766-8.218l109.283-63.095c7.868 6.733 18.07 10.813 29.214 10.813 24.813 0 45-20.187 45-45 .002-19.554-12.539-36.227-29.998-42.419zm-351.249-134.393 29.105 16.803-7.5 12.99c-1.989 3.445-2.528 7.539-1.499 11.382s3.543 7.119 6.989 9.108l21.784 12.577c-.242 2.839-.361 5.645-.361 8.452s.119 5.613.361 8.452l-21.784 12.577c-3.445 1.989-5.959 5.266-6.989 9.108-1.03 3.843-.491 7.937 1.499 11.382l7.5 12.99-29.081 16.79c-4.241-3.618-9.08-6.372-14.237-8.193v-126.185c5.253-1.864 10.058-4.678 14.213-8.233zm292.015-25.968-29.083 16.791-7.5-12.99c-4.143-7.176-13.315-9.634-20.49-5.49l-21.82 12.598c-4.627-3.192-9.504-6.003-14.604-8.417v-25.211c0-8.284-6.716-15-15-15h-15v-33.58c5.254-1.864 10.059-4.677 14.214-8.233l109.283 63.095c-.494 2.667-.766 5.411-.766 8.218s.271 5.552.766 8.219zm-64.814 83.585c.886 4.803 1.316 9.283 1.316 13.696s-.431 8.894-1.316 13.696c-1.152 6.243 1.752 12.536 7.251 15.711l17.499 10.103-15 25.98-17.505-10.105c-5.507-3.181-12.42-2.542-17.25 1.591-6.974 5.965-14.942 10.559-23.685 13.654-5.99 2.12-9.994 7.785-9.994 14.14v20.23h-30v-20.23c0-6.354-4.004-12.02-9.994-14.14-8.742-3.096-16.711-7.689-23.685-13.654-4.831-4.132-11.744-4.77-17.25-1.591l-17.504 10.105-15-25.98 17.499-10.103c5.499-3.175 8.403-9.468 7.251-15.713-.886-4.799-1.316-9.278-1.316-13.694s.431-8.896 1.316-13.694c1.152-6.245-1.752-12.538-7.251-15.713l-17.499-10.103 15-25.98 17.504 10.105c5.506 3.18 12.419 2.541 17.251-1.592 6.97-5.963 14.938-10.556 23.685-13.653 5.99-2.121 9.993-7.786 9.993-14.14v-20.23h30v20.23c0 6.354 4.003 12.019 9.993 14.14 8.746 3.098 16.715 7.69 23.685 13.653 4.832 4.133 11.743 4.771 17.251 1.592l17.505-10.105 15 25.98-17.499 10.103c-5.499 3.175-8.403 9.468-7.251 15.711zm-88.683-121.304h-15c-8.284 0-15 6.716-15 15v25.21c-5.1 2.414-9.977 5.225-14.603 8.417l-21.82-12.598c-7.177-4.144-16.35-1.685-20.49 5.49l-7.5 12.99-29.083-16.792c.494-2.667.766-5.411.766-8.218s-.271-5.552-.766-8.218l109.284-63.095c4.155 3.556 8.959 6.37 14.213 8.233v33.581zm-123.495 232.28 29.081-16.79 7.5 12.99c4.142 7.175 13.315 9.636 20.49 5.49l21.82-12.598c4.628 3.193 9.503 6.004 14.603 8.417v25.211c0 8.284 6.716 15 15 15h15v33.58c-5.254 1.864-10.058 4.677-14.213 8.233l-109.305-63.108c1.002-5.375 1.037-10.943.024-16.425zm153.495 37.72h15c8.284 0 15-6.716 15-15v-25.21c5.1-2.413 9.976-5.224 14.604-8.417l21.82 12.598c7.174 4.142 16.348 1.684 20.49-5.49l7.5-12.99 29.083 16.791c-.494 2.667-.766 5.411-.766 8.219s.271 5.552.766 8.218l-109.283 63.095c-4.155-3.556-8.96-6.37-14.214-8.233zm138.518-63.687-29.104-16.803 7.5-12.99c1.989-3.445 2.528-7.54 1.499-11.383-1.03-3.842-3.544-7.118-6.989-9.107l-21.785-12.577c.242-2.839.361-5.646.361-8.452s-.119-5.613-.361-8.452l21.785-12.577c3.445-1.989 5.959-5.266 6.989-9.107 1.029-3.843.49-7.938-1.499-11.383l-7.5-12.99 29.104-16.803c4.155 3.556 8.959 6.37 14.213 8.233v126.16c-5.254 1.862-10.058 4.675-14.213 8.231zm29.213-191.813c8.271 0 15 6.729 15 15s-6.729 15-15 15-15-6.729-15-15 6.729-15 15-15zm-182.731-105.5c8.271 0 15 6.729 15 15s-6.729 15-15 15-15-6.729-15-15 6.729-15 15-15zm-182.732 105.5c8.271 0 15 6.729 15 15s-6.729 15-15 15-15-6.729-15-15 6.729-15 15-15zm7.5 238.99c-7.162 4.137-16.354 1.674-20.49-5.49-2.003-3.47-2.536-7.512-1.499-11.382s3.519-7.104 6.989-9.108c2.312-1.334 4.876-2.016 7.476-2.016 1.303 0 2.615.171 3.907.518 3.871 1.037 7.105 3.519 9.108 6.988 4.135 7.163 1.672 16.354-5.491 20.49zm175.232 107.51c-8.271 0-15-6.729-15-15s6.729-15 15-15 15 6.729 15 15-6.729 15-15 15zm182.731-105.5c-8.271 0-15-6.729-15-15s6.729-15 15-15 15 6.729 15 15-6.728 15-15 15z"/>
                    <path d="m256.01 211c-24.813 0-45 20.187-45 45s20.187 45 45 45 45-20.187 45-45-20.187-45-45-45zm0 60c-8.271 0-15-6.729-15-15s6.729-15 15-15 15 6.729 15 15-6.729 15-15 15z"/>
                </g>
            </svg>
            Connect API
        </li>
        <li class="tab-link" data-tab="tab2">

            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 x="0px" y="0px"
                 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                <g>
                    <g>
                        <path d="M386.689,304.403c-35.587,0-64.538,28.951-64.538,64.538s28.951,64.538,64.538,64.538
                            c35.593,0,64.538-28.951,64.538-64.538S422.276,304.403,386.689,304.403z M386.689,401.21c-17.796,0-32.269-14.473-32.269-32.269
                            c0-17.796,14.473-32.269,32.269-32.269c17.796,0,32.269,14.473,32.269,32.269C418.958,386.738,404.485,401.21,386.689,401.21z"/>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M166.185,304.403c-35.587,0-64.538,28.951-64.538,64.538s28.951,64.538,64.538,64.538s64.538-28.951,64.538-64.538
                            S201.772,304.403,166.185,304.403z M166.185,401.21c-17.796,0-32.269-14.473-32.269-32.269c0-17.796,14.473-32.269,32.269-32.269
                            c17.791,0,32.269,14.473,32.269,32.269C198.454,386.738,183.981,401.21,166.185,401.21z"/>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M430.15,119.675c-2.743-5.448-8.32-8.885-14.419-8.885h-84.975v32.269h75.025l43.934,87.384l28.838-14.5L430.15,119.675z"
                        />
                    </g>
                </g>
                <g>
                    <g>
                        <rect x="216.202" y="353.345" width="122.084" height="32.269"/>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M117.781,353.345H61.849c-8.912,0-16.134,7.223-16.134,16.134c0,8.912,7.223,16.134,16.134,16.134h55.933
                            c8.912,0,16.134-7.223,16.134-16.134C133.916,360.567,126.693,353.345,117.781,353.345z"/>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M508.612,254.709l-31.736-40.874c-3.049-3.937-7.755-6.239-12.741-6.239H346.891V94.655
                            c0-8.912-7.223-16.134-16.134-16.134H61.849c-8.912,0-16.134,7.223-16.134,16.134s7.223,16.134,16.134,16.134h252.773v112.941
                            c0,8.912,7.223,16.134,16.134,16.134h125.478l23.497,30.268v83.211h-44.639c-8.912,0-16.134,7.223-16.134,16.134
                            c0,8.912,7.223,16.134,16.134,16.134h60.773c8.912,0,16.134-7.223,16.135-16.134V264.605
                            C512,261.023,510.806,257.538,508.612,254.709z"/>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M116.706,271.597H42.487c-8.912,0-16.134,7.223-16.134,16.134c0,8.912,7.223,16.134,16.134,16.134h74.218
                            c8.912,0,16.134-7.223,16.134-16.134C132.84,278.82,125.617,271.597,116.706,271.597z"/>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M153.815,208.134H16.134C7.223,208.134,0,215.357,0,224.269s7.223,16.134,16.134,16.134h137.681
                            c8.912,0,16.134-7.223,16.134-16.134S162.727,208.134,153.815,208.134z"/>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M180.168,144.672H42.487c-8.912,0-16.134,7.223-16.134,16.134c0,8.912,7.223,16.134,16.134,16.134h137.681
                            c8.912,0,16.134-7.223,16.134-16.134C196.303,151.895,189.08,144.672,180.168,144.672z"/>
                    </g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                </svg>
            Shippings
        </li>
        <li class="tab-link" data-tab="tab3">

            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 x="0px" y="0px"
                 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                <g>
                    <g>
                        <path d="M105.054,321.244c-35.365,0-64.138,28.768-64.138,64.138s28.774,64.138,64.138,64.138
                            c35.364,0,64.138-28.774,64.138-64.138C169.192,350.018,140.418,321.244,105.054,321.244z M105.054,416.351
                            c-17.074,0-30.963-13.889-30.963-30.963c0-17.074,13.889-30.969,30.963-30.969s30.963,13.895,30.963,30.969
                            C136.017,402.462,122.128,416.351,105.054,416.351z"/>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M391.464,321.244c-35.37,0-64.138,28.768-64.138,64.138s28.774,64.138,64.138,64.138
                            c35.365,0,64.138-28.774,64.138-64.138C455.603,350.018,426.834,321.244,391.464,321.244z M391.464,416.351
                            c-17.074,0-30.963-13.889-30.963-30.963c0-17.074,13.889-30.969,30.963-30.969c17.074,0,30.969,13.895,30.969,30.969
                            C422.433,402.462,408.538,416.351,391.464,416.351z"/>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M63.032,144.864c-6.209,0-11.899,3.467-14.746,8.99L1.841,243.98C0.63,246.329,0,248.934,0,251.577v133.806
                            c0,9.162,7.426,16.587,16.587,16.587H56.95v-33.175H33.175V255.602l39.97-77.563h126.457v-33.175H63.032z"/>
                    </g>
                </g>
                <g>
                    <g>
                        <rect x="154.263" y="368.795" width="189.097" height="33.175"/>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M495.413,62.479h-295.81c-9.162,0-16.587,7.426-16.587,16.587v306.315h33.175V95.654h262.635v273.14h-39.81v33.175h56.397
                            c9.162,0,16.587-7.426,16.587-16.587V79.067C512,69.905,504.574,62.479,495.413,62.479z"/>
                    </g>
                </g>
                <g>
                    <g>
                        <rect x="16.587" y="235.542" width="183.015" height="33.175"/>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M428.742,163.702c-6.088-6.856-16.576-7.47-23.416-1.382l-82.23,73.04l-32.622-33.042
                            c-6.436-6.519-16.941-6.585-23.455-0.149c-6.519,6.436-6.585,16.941-0.149,23.46l43.675,44.233
                            c3.235,3.279,7.52,4.938,11.81,4.938c3.926,0,7.857-1.388,11.003-4.186l93.996-83.496
                            C434.205,181.036,434.824,170.552,428.742,163.702z"/>
                    </g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                </svg>

            Send Products To Etsy
        </li>
        <li class="tab-link video" data-tab="tab4">

            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 x="0px" y="0px"
                 viewBox="0 0 611.998 611.998" style="enable-background:new 0 0 611.998 611.998;" xml:space="preserve">
                <g>
                    <g>
                        <g>
                            <path d="M226.378,331.763c-8.34,0-16.57,1.451-24.466,4.306c-18.064,6.539-32.504,19.717-40.655,37.112
                                c-8.154,17.397-9.042,36.926-2.505,54.99c10.274,28.392,37.453,47.466,67.632,47.466c8.34,0,16.57-1.448,24.469-4.306
                                c37.288-13.495,56.65-54.809,43.157-92.098C283.739,350.84,256.557,331.763,226.378,331.763z M239.601,440.236
                                c-4.278,1.55-8.727,2.333-13.218,2.333c-16.302,0-30.986-10.306-36.538-25.65c-3.531-9.76-3.052-20.308,1.353-29.706
                                c4.402-9.396,12.203-16.517,21.96-20.051c4.278-1.547,8.727-2.333,13.218-2.333c16.302,0,30.986,10.308,36.538,25.653
                                C270.205,410.628,259.746,432.947,239.601,440.236z"/>
                            <path d="M418.902,395.925l-19.774-0.901c-0.603-11.635-2.371-23.142-5.258-34.342l18.648-6.746
                                c8.586-3.108,13.03-12.586,9.921-21.172c-3.105-8.586-12.583-13.024-21.172-9.921l-18.645,6.746
                                c-4.949-10.455-10.952-20.427-17.933-29.754l14.614-13.342c6.744-6.157,7.222-16.615,1.065-23.357
                                c-6.155-6.744-16.612-7.222-23.357-1.065l-14.585,13.312c-8.487-7.685-17.841-14.604-27.999-20.602l8.382-17.889
                                c3.876-8.267,0.315-18.112-7.951-21.988c-8.269-3.873-18.115-0.316-21.988,7.954l-8.382,17.886
                                c-10.993-3.945-22.265-6.746-33.75-8.374l0.896-19.684c0.417-9.119-6.641-16.85-15.763-17.268
                                c-9.13-0.417-16.853,6.641-17.268,15.763l-0.898,19.732c-11.706,0.601-23.213,2.371-34.359,5.26l-6.733-18.614
                                c-3.105-8.586-12.583-13.027-21.169-9.924c-8.586,3.105-13.03,12.586-9.924,21.172l6.765,18.699
                                c-10.477,4.989-20.432,11-29.709,17.956l-13.406-14.69c-6.155-6.744-16.612-7.222-23.357-1.065
                                c-6.744,6.154-7.222,16.612-1.065,23.357l13.377,14.658c-7.744,8.53-14.671,17.877-20.638,27.943l-17.919-8.399
                                c-8.269-3.873-18.111-0.313-21.985,7.957c-3.876,8.267-0.313,18.111,7.954,21.985l17.889,8.382
                                c-3.969,11.112-6.733,22.414-8.337,33.753l-19.724-0.901c-9.13-0.42-16.853,6.641-17.27,15.763
                                c-0.417,9.122,6.641,16.853,15.763,17.268l19.771,0.901c0.605,11.635,2.371,23.142,5.258,34.342l-18.648,6.748
                                c-8.586,3.105-13.027,12.586-9.921,21.172c2.435,6.728,8.783,10.912,15.548,10.912c1.867,0,3.767-0.32,5.624-0.991l18.648-6.748
                                c4.946,10.455,10.952,20.427,17.933,29.754l-14.617,13.342c-6.743,6.154-7.22,16.615-1.065,23.357
                                c3.261,3.574,7.731,5.387,12.217,5.387c3.978,0,7.97-1.429,11.141-4.322l14.585-13.312c8.487,7.685,17.841,14.604,28.002,20.602
                                l-8.382,17.889c-3.876,8.267-0.316,18.111,7.954,21.985c2.268,1.062,4.655,1.567,7.005,1.567c6.217,0,12.171-3.52,14.983-9.52
                                l8.38-17.883c10.993,3.945,22.265,6.747,33.75,8.374l-0.896,19.681c-0.415,9.122,6.641,16.853,15.763,17.268
                                c0.256,0.014,0.511,0.019,0.765,0.019c8.786,0,16.101-6.916,16.504-15.782l0.898-19.73c11.706-0.601,23.213-2.374,34.356-5.263
                                l6.736,18.614c2.436,6.73,8.783,10.912,15.548,10.912c1.867,0,3.767-0.317,5.624-0.991c8.586-3.108,13.03-12.586,9.921-21.172
                                l-6.765-18.696c10.477-4.986,20.43-11,29.706-17.954l13.411,14.687c3.261,3.574,7.728,5.387,12.214,5.387
                                c3.98,0,7.97-1.429,11.143-4.325c6.744-6.157,7.217-16.615,1.064-23.357l-13.38-14.655c7.744-8.53,14.673-17.877,20.639-27.943
                                l17.917,8.399c2.269,1.064,4.655,1.567,7.005,1.567c6.214,0,12.168-3.52,14.98-9.52c3.876-8.267,0.315-18.111-7.951-21.985
                                l-17.892-8.385c3.969-11.112,6.733-22.411,8.337-33.747l19.727,0.898c0.259,0.014,0.511,0.019,0.767,0.019
                                c8.783,0,16.098-6.916,16.504-15.78C435.08,404.073,428.025,396.341,418.902,395.925z M353.093,463.083
                                c-22.943,48.956-72.723,80.591-126.82,80.591c-20.556,0-40.5-4.461-59.276-13.261C97.13,497.669,66.926,414.188,99.667,344.32
                                c22.943-48.959,72.723-80.594,126.82-80.594c20.556,0,40.5,4.461,59.273,13.258C355.63,309.727,385.833,393.209,353.093,463.083z
                                "/>
                            <path d="M510.207,123.471c-9.461-26.15-34.492-43.719-62.29-43.719c-7.682,0-15.263,1.332-22.536,3.964
                                c-34.348,12.429-52.178,50.483-39.751,84.827c9.458,26.149,34.49,43.717,62.288,43.717c7.682,0,15.266-1.335,22.539-3.967
                                c16.635-6.019,29.935-18.159,37.442-34.178C515.405,158.093,516.227,140.106,510.207,123.471z M416.723,157.291
                                c-6.225-17.2,2.707-36.257,19.907-42.482c3.654-1.321,7.451-1.991,11.285-1.991c13.918,0,26.455,8.803,31.197,21.901
                                c3.015,8.331,2.605,17.341-1.157,25.362c-3.759,8.021-10.42,14.1-18.75,17.117c-3.657,1.321-7.454,1.994-11.288,1.994
                                C433.999,179.192,421.462,170.389,416.723,157.291z"/>
                            <path d="M578.142,135.388l-8.526-0.387c-0.949-10.311-3.202-20.57-6.819-30.564c-3.614-9.994-8.447-19.319-14.314-27.849
                                l6.296-5.748c6.744-6.157,7.222-16.615,1.065-23.357c-6.154-6.743-16.612-7.222-23.357-1.065l-6.296,5.748
                                c-7.962-6.62-16.81-12.279-26.434-16.79c-9.614-4.504-19.588-7.696-29.816-9.574l0.387-8.515
                                c0.417-9.122-6.641-16.853-15.763-17.27c-9.097-0.408-16.85,6.641-17.268,15.763l-0.39,8.552
                                c-21.161,1.945-41.223,9.391-58.332,21.189l-5.828-6.386c-6.157-6.744-16.612-7.217-23.357-1.065
                                c-6.744,6.157-7.22,16.615-1.065,23.357l5.805,6.356c-6.646,7.939-12.341,16.773-16.843,26.379
                                c-4.509,9.622-7.685,19.633-9.569,29.814l-8.52-0.387c-9.139-0.431-16.853,6.644-17.27,15.763
                                c-0.415,9.122,6.644,16.853,15.766,17.268l8.517,0.387c0.949,10.311,3.205,20.57,6.819,30.564
                                c3.617,9.994,8.45,19.318,14.316,27.849l-6.299,5.751c-6.744,6.154-7.22,16.615-1.062,23.357
                                c3.261,3.571,7.728,5.384,12.214,5.384c3.98,0,7.97-1.429,11.143-4.322l6.296-5.751c7.962,6.62,16.81,12.279,26.433,16.79
                                c9.615,4.505,19.588,7.696,29.819,9.574l-0.39,8.517c-0.415,9.122,6.644,16.853,15.763,17.268
                                c0.259,0.014,0.511,0.019,0.767,0.019c8.783,0,16.101-6.916,16.503-15.782l0.39-8.552c21.161-1.945,41.223-9.391,58.329-21.189
                                l5.831,6.386c3.261,3.574,7.728,5.387,12.214,5.387c3.98,0,7.973-1.429,11.143-4.325c6.744-6.157,7.217-16.615,1.061-23.357
                                l-5.799-6.353c6.644-7.936,12.338-16.77,16.84-26.377c4.507-9.622,7.685-19.633,9.569-29.814l8.52,0.387
                                c0.259,0.014,0.514,0.019,0.767,0.019c8.786,0,16.101-6.916,16.504-15.78C594.32,143.536,587.262,135.806,578.142,135.388z
                                M410.102,226.688c-21.552-10.096-37.878-27.987-45.978-50.367c-8.097-22.38-6.994-46.576,3.105-68.127
                                c14.61-31.178,46.308-51.322,80.755-51.322c13.086,0,25.785,2.842,37.741,8.447c21.551,10.099,37.88,27.987,45.978,50.37
                                c8.1,22.381,6.996,46.576-3.103,68.127c-14.609,31.175-46.306,51.319-80.755,51.319
                                C434.763,235.135,422.062,232.292,410.102,226.688z"/>
                        </g>
                    </g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                </svg>

            Other options
        </li>
    </ul>
    <!-- rex-etsy-api-setting__tabs-area -->

    <div class="rex-etsy-api-setting__tab-content">
        <div id="tab1" class="tab-content block-wrapper active">
            <div class="rex-etsy-api-settings" id="rex-etsy-api-settings">
                <div class="rex-etsy-api-settings__content">

                    <div class="rex-etsy-api-settings__configure-form">
                        <h2 class="rex-etsy-api-settings__title"><?php esc_html_e('Configure To Etsy API', 'etsy-product-feed'); ?></h2>
                        <div class="rex-etsy-api-settings__input-field">
                            <div class="rex-etsy-api-settings__level-area">
                                <label for="fname" class="rex-etsy-api-settings__width-modify">Consumer Key:</label>
                                <span>*</span>
                                <span class="etsy-tooltip">
                                            <span class="icon">
                                                <img src="<?php echo plugin_dir_url(__DIR__) . 'icon/info-circle.png'; ?>"
                                                     alt="info-circle">
                                            </span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores mollitia omnis eveniet!</p>
                                        </span>
                            </div>

                            <div class="rex-etsy-api-settings__input-area">
                                <input type="text" id="consumer_key" name="consumer_key"  autocomplete="on"
                                       value="<?php echo isset($_COOKIE['c_key']) ? $_COOKIE['c_key'] : '' ?>">

                                <p id="rex-etsy-consumer-key_validatioin" style="color: red;font-size: 13px">
                                </p>
                            </div>
                        </div>

                        <div class="rex-etsy-api-settings__input-field">
                            <div class="rex-etsy-api-settings__level-area">
                                <label for="lname">Consumer secret:</label>
                                <span>*</span>
                                <span class="etsy-tooltip">
                                            <span class="icon">
                                                <img src="<?php echo plugin_dir_url(__DIR__) . 'icon/info-circle.png'; ?>"
                                                     alt="info-circle">
                                            </span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores mollitia omnis eveniet!</p>
                                        </span>
                            </div>

                            <div class="rex-etsy-api-settings__input-area">
                                <input type="text" id="consumer_secret" name="consumer_secret"
                                       autocomplete="on"
                                       value="<?php echo isset($_COOKIE['c_secret']) ? $_COOKIE['c_secret'] : '' ?>">
                                <p id="rex-etsy-consumer-secret_validatioin" style="color: red;font-size: 13px">
                                </p>

                            </div>
                        </div>

                        <div class="rex-etsy-api-settings__button-area">
                            <button id="etsy_submit" class="btn-default-bg btn--small">Submit</button>
                            <button id="show_response" class="btn-visibility btn--hover"  disabled><a
                                        href="#" id="w3s">Do Authorization</a></button>
                        </div>
                        <p id="show_error"></p>
                    </div>
                    <!-- rex-etsy-api-settings__configure-form -->

                    <div class="rex-etsy-api-settings__video">
                        <div class="video-container">
                            <iframe width="853" height="480" src="//www.youtube.com/embed/CVMqRunbW5g" frameborder="0"
                                    allowfullscreen=""></iframe>
                        </div>
                    </div>
                    <!-- rex-etsy-api-settings__video -->
                </div>
            </div>
        </div>
        <!-- rex-general__block-wrapper.end #tab1 -->

        <div id="tab2" class="tab-content block-wrapper">
            <div class="rex-etsy-api-settings" id="rex-etsy-api-settings">
            <!-- rex-shipping-template-id generation starts-->
            <div class="rex-etsy-api-settings__content">
            <div class="rex-etsy-api-settings__shipping-form">
                        <h2 class="rex-etsy-api-settings__title"><?php esc_html_e('Generate Shipping ID', 'etsy-product-feed'); ?></h2>

                        <div class="rex-etsy-api-settings__input-field">
                            <div class="rex-etsy-api-settings__level-area">
                                <label for="fname" class="rex-etsy-api-settings__width-modify">Template Name:</label>
                                <span>*</span>
                                <span class="etsy-tooltip">
                                    <span class="icon">
                                        <img src="<?php echo plugin_dir_url(__DIR__) . 'icon/info-circle.png'; ?>"
                                            alt="info-circle">
                                    </span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores mollitia omnis eveniet!</p>
                                </span>
                            </div>
                            <!-- end rex-etsy-api-settings__level-area -->

                            <div class="rex-etsy-api-settings__input-area">
                                <input type="text" name="title" id="shipping_title" value=""  onkeypress="myFunction()">
                                <p id="validate_shipping_title" style="font-size: 13px;color: red"></p>
                            </div>
                             <!-- end rex-etsy-api-settings__input-area -->
                        </div>
                        <!-- end rex-etsy-api-settings__input-field -->

                        <div class="rex-etsy-api-settings__input-field">
                            <div class="rex-etsy-api-settings__level-area">
                                 <label for="lname" class="rex-etsy-api-settings__width-modify">Shipping Country:</label>
                                  <span>*</span>
                                    <span class="etsy-tooltip">
                                            <span class="icon">
                                                <img src="<?php echo plugin_dir_url(__DIR__) . 'icon/info-circle.png'; ?>"
                                                    alt="info-circle">
                                            </span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores mollitia omnis eveniet!</p>
                                    </span>
                            </div>
                            <!-- end rex-etsy-api-settings__level-area -->

                            <div class="rex-etsy-api-settings__input-area">
                                <select name="origin_country_id" id="origin_country_id" value="">
                                    <option value="55">Afghanistan</option>
                                    <option value="306">Åland Islands</option>
                                    <option value="57">Albania</option>
                                    <option value="95">Algeria</option>
                                    <option value="250">American Samoa</option>
                                    <option value="228">Andorra</option>
                                    <option value="56">Angola</option>
                                    <option value="251">Anguilla</option>
                                    <option value="10">Antarctica</option>
                                    <option value="252">Antigua and Barbuda</option>
                                    <option value="59">Argentina</option>
                                    <option value="60">Armenia</option>
                                    <option value="253">Aruba</option>
                                    <option value="61">Australia</option>
                                    <option value="62">Austria</option>
                                    <option value="63">Azerbaijan</option>
                                    <option value="229">Bahamas</option>
                                    <option value="232">Bahrain</option>
                                    <option value="68">Bangladesh</option>
                                    <option value="237">Barbados</option>
                                    <option value="71">Belarus</option>
                                    <option value="65">Belgium</option>
                                    <option value="72">Belize</option>
                                    <option value="66">Benin</option>
                                    <option value="225">Bermuda</option>
                                    <option value="76">Bhutan</option>
                                    <option value="73">Bolivia</option>
                                    <option value="535">Bonaire, Sint Eustatius and Saba</option>
                                    <option value="70">Bosnia and Herzegovina</option>
                                    <option value="77">Botswana</option>
                                    <option value="254">Bouvet Island</option>
                                    <option value="74">Brazil</option>
                                    <option value="255">British Indian Ocean Territory</option>
                                    <option value="231">British Virgin Islands</option>
                                    <option value="75">Brunei</option>
                                    <option value="69">Bulgaria</option>
                                    <option value="67">Burkina Faso</option>
                                    <option value="64">Burundi</option>
                                    <option value="135">Cambodia</option>
                                    <option value="84">Cameroon</option>
                                    <option value="79">Canada</option>
                                    <option value="222">Cape Verde</option>
                                    <option value="247">Cayman Islands</option>
                                    <option value="78">Central African Republic</option>
                                    <option value="196">Chad</option>
                                    <option value="81">Chile</option>
                                    <option value="82">China</option>
                                    <option value="257">Christmas Island</option>
                                    <option value="258">Cocos (Keeling) Islands</option>
                                    <option value="86">Colombia</option>
                                    <option value="259">Comoros</option>
                                    <option value="85">Congo, Republic of</option>
                                    <option value="260">Cook Islands</option>
                                    <option value="87">Costa Rica</option>
                                    <option value="118">Croatia</option>
                                    <option value="338">Curaçao</option>
                                    <option value="89">Cyprus</option>
                                    <option value="90">Czech Republic</option>
                                    <option value="93">Denmark</option>
                                    <option value="92">Djibouti</option>
                                    <option value="261">Dominica</option>
                                    <option value="94">Dominican Republic</option>
                                    <option value="96">Ecuador</option>
                                    <option value="97">Egypt</option>
                                    <option value="187">El Salvador</option>
                                    <option value="111">Equatorial Guinea</option>
                                    <option value="98">Eritrea</option>
                                    <option value="100">Estonia</option>
                                    <option value="101">Ethiopia</option>
                                    <option value="262">Falkland Islands (Malvinas)</option>
                                    <option value="241">Faroe Islands</option>
                                    <option value="234">Fiji</option>
                                    <option value="102">Finland</option>
                                    <option value="103">France</option>
                                    <option value="115">French Guiana</option>
                                    <option value="263">French Polynesia</option>
                                    <option value="264">French Southern Territories</option>
                                    <option value="104">Gabon</option>
                                    <option value="109">Gambia</option>
                                    <option value="106">Georgia</option>
                                    <option value="91">Germany</option>
                                    <option value="107">Ghana</option>
                                    <option value="226">Gibraltar</option>
                                    <option value="112">Greece</option>
                                    <option value="113">Greenland</option>
                                    <option value="245">Grenada</option>
                                    <option value="265">Guadeloupe</option>
                                    <option value="266">Guam</option>
                                    <option value="114">Guatemala</option>
                                    <option value="305">Guernsey</option>
                                    <option value="108">Guinea</option>
                                    <option value="110">Guinea-Bissau</option>
                                    <option value="116">Guyana</option>
                                    <option value="119">Haiti</option>
                                    <option value="267">Heard Island and McDonald Islands</option>
                                    <option value="268">Holy See (Vatican City State)</option>
                                    <option value="117">Honduras</option>
                                    <option value="219">Hong Kong</option>
                                    <option value="120">Hungary</option>
                                    <option value="126">Iceland</option>
                                    <option value="122">India</option>
                                    <option value="121">Indonesia</option>
                                    <option value="125">Iraq</option>
                                    <option value="123">Ireland</option>
                                    <option value="269">Isle of Man</option>
                                    <option value="127">Israel</option>
                                    <option value="128">Italy</option>
                                    <option value="83">Ivory Coast</option>
                                    <option value="129">Jamaica</option>
                                    <option value="131">Japan</option>
                                    <option value="307">Jersey</option>
                                    <option value="130">Jordan</option>
                                    <option value="132">Kazakhstan</option>
                                    <option value="133">Kenya</option>
                                    <option value="270">Kiribati</option>
                                    <option value="271">Kosovo</option>
                                    <option value="137">Kuwait</option>
                                    <option value="134">Kyrgyzstan</option>
                                    <option value="138">Laos</option>
                                    <option value="146">Latvia</option>
                                    <option value="139">Lebanon</option>
                                    <option value="143">Lesotho</option>
                                    <option value="140">Liberia</option>
                                    <option value="141">Libya</option>
                                    <option value="272">Liechtenstein</option>
                                    <option value="144">Lithuania</option>
                                    <option value="145">Luxembourg</option>
                                    <option value="273">Macao</option>
                                    <option value="151">Macedonia</option>
                                    <option value="149">Madagascar</option>
                                    <option value="158">Malawi</option>
                                    <option value="159">Malaysia</option>
                                    <option value="238">Maldives</option>
                                    <option value="152">Mali</option>
                                    <option value="227">Malta</option>
                                    <option value="274">Marshall Islands</option>
                                    <option value="275">Martinique</option>
                                    <option value="157">Mauritania</option>
                                    <option value="239">Mauritius</option>
                                    <option value="276">Mayotte</option>
                                    <option value="150">Mexico</option>
                                    <option value="277">Micronesia, Federated States of</option>
                                    <option value="148">Moldova</option>
                                    <option value="278">Monaco</option>
                                    <option value="154">Mongolia</option>
                                    <option value="155">Montenegro</option>
                                    <option value="279">Montserrat</option>
                                    <option value="147">Morocco</option>
                                    <option value="156">Mozambique
                                    </option>
                                    <option value="153">Myanmar (Burma)</option>
                                    <option value="160">Namibia</option>
                                    <option> value="280">Nauru
                                    </option>
                                    <option value="166">Nepal</option>
                                    <option value="243">Netherlands Antilles</option>
                                    <option value="233">New Caledonia</option>
                                    <option value="167">New Zealand</option>
                                    <option value="163">Nicaragua</option>
                                    <option value="161">Niger</option>
                                    <option value="162">Nigeria</option>
                                    <option value="281">Niue</option>
                                    <option value="282">Norfolk Island</option>
                                    <option value="283">Northern Mariana Islands</option>
                                    <option value="165">Norway</option>
                                    <option value="168">Oman</option>
                                    <option value="169">Pakistan</option>
                                    <option value="284">Palau</option>
                                    <option value="285">Palestine, State of</option>
                                    <option value="170">Panama
                                    </option
                                    >
                                    <option value="173">Papua New Guinea</option>
                                    <option value="178">Paraguay</option>
                                    <option value="171">Peru</option>
                                    <option value="172">Philippines</option>
                                    <option value="174">Poland</option>
                                    <option value="177">Portugal</option>
                                    <option value="175">Puerto Rico</option>
                                    <option value="179">Qatar</option>
                                    <option value="304">Reunion</option>
                                    <option value="180">Romania</option>
                                    <option value="181">Russia</option>
                                    <option value="182">Rwanda</option>
                                    <option value="308">Saint Barthélemy</option>
                                    <option value="286">Saint Helena</option>
                                    <option value="287">Saint Kitts and Nevis</option>
                                    <option value="244">Saint Lucia</option>
                                    <option value="288">Saint Martin (French part)</option>
                                    <option value="289">Saint Pierre and Miquelon</option>
                                    <option value="249">Saint Vincent and the Grenadines</option>
                                    <option value="290">Samoa</option>
                                    <option value="291">San Marino</option>
                                    <option value="292">Sao Tome and Principe</option>
                                    <option value="183">Saudi Arabia</option>
                                    <option value="185">Senegal</option>
                                    <option value="189">Serbia</option>
                                    <option value="891">Serbia and Montenegro</option>
                                    <option value="293">Seychelles</option>
                                    <option value="186">Sierra Leone</option>
                                    <option value="220">Singapore</option>
                                    <option value="337">Sint Maarten (Dutch part)</option>
                                    <option value="191">Slovakia</option>
                                    <option value="192">Slovenia</option>
                                    <option value="242">Solomon Islands</option>
                                    <option value="188">Somalia</option>
                                    <option value="215">South Africa</option>
                                    <option value="294">South Georgia and the South Sandwich Islands</option>
                                    <option value="136">South Korea</option>
                                    <option value="339">South Sudan</option>
                                    <option value="99">Spain</option>
                                    <option value="142">Sri Lanka</option>
                                    <option value="184">Sudan</option>
                                    <option value="190">Suriname</option>
                                    <option value="295">Svalbard and Jan Mayen</option>
                                    <option value="194">Swaziland</option>
                                    <option value="193">Sweden</option>
                                    <option value="80">Switzerland</option>
                                    <option value="204">Taiwan</option>
                                    <option value="199">Tajikistan</option>
                                    <option value="205">Tanzania</option>
                                    <option value="198">Thailand</option>
                                    <option value="164">The Netherlands</option>
                                    <option value="296">Timor-Leste</option>
                                    <option value="197">Togo</option>
                                    <option value="297">Tokelau</option>
                                    <option value="298">Tonga</option>
                                    <option value="201">Trinidad</option>
                                    <option value="202">Tunisia</option>
                                    <option value="203">Turkey</option>
                                    <option value="200">Turkmenistan</option>
                                    <option value="299">Turks and Caicos Islands</option>
                                    <option value="300">Tuvalu</option>
                                    <option value="206">Uganda</option>
                                    <option value="207">Ukraine</option>
                                    <option value="58">United Arab Emirates</option>
                                    <option value="105">United Kingdom</option>
                                    <option value="209">United States</option>
                                    <option value="302">United States Minor Outlying Islands</option>
                                    <option value="208">Uruguay</option>
                                    <option value="248">U.S. Virgin Islands</option>
                                    <option value="210">Uzbekistan</option>
                                    <option value="221">Vanuatu</option>
                                    <option value="211">Venezuela</option>
                                    <option value="212">Vietnam</option>
                                    <option value="224">Wallis and Futuna</option>
                                    <option value="213">Western Sahara</option>
                                    <option value="214">Yemen</option>
                                    <option value="216">Zaire (Democratic Republic of Congo)</option>
                                    <option value="217">Zambia</option>
                                    <option value="218">Zimbabwe</option>
                                </select>
                                <p id="validate_shipping_country" style="font-size: 13px;color: red"></p>
                            </div>
                             <!-- end rex-etsy-api-settings__input-area -->

                        </div>
                        <!-- end rex-etsy-api-settings__input-field -->

                        <div class="rex-etsy-api-settings__input-field">
                            <div class="rex-etsy-api-settings__level-area">
                                <label for="fname" class="rex-etsy-api-settings__width-modify">Cost:</label>
                                <span>*</span>
                                    <span class="etsy-tooltip">
                                        <span class="icon">
                                            <img src="<?php echo plugin_dir_url(__DIR__) . 'icon/info-circle.png'; ?>"
                                                    alt="info-circle">
                                        </span>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores mollitia omnis eveniet!</p>
                                    </span>
                            </div>
                            <!-- end rex-etsy-api-settings__level-area -->

                            <div class="rex-etsy-api-settings__input-area">
                                <input type="text" name="primary_cost"  id="primary_cost" placeholder="One Item">
                                <p id="validate_shipping_primary_cost" style="font-size: 13px;color: red"></p>
                            </div>
                             <!-- end rex-etsy-api-settings__input-area -->
                        </div>
                        <!-- end rex-etsy-api-settings__input-field -->

                        <div class="rex-etsy-api-settings__input-field">
                            <div class="rex-etsy-api-settings__level-area">
                                <label for="fname" class="rex-etsy-api-settings__width-modify">Additional cost per item:</label>
                                <span>*</span>
                                    <span class="etsy-tooltip">
                                            <span class="icon">
                                                <img src="<?php echo plugin_dir_url(__DIR__) . 'icon/info-circle.png'; ?>"
                                                        alt="info-circle">
                                            </span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores mollitia omnis eveniet!</p>
                                    </span>
                             </div>
                            <!-- end rex-etsy-api-settings__level-area -->

                            <div class="rex-etsy-api-settings__input-area">
                                <input type="text" name="secondary_cost"  id="secondary_cost"
                                    placeholder="additional cost per item">
                                <p id="validate_shipping_additional_cost" style="font-size: 13px;color: red"></p>
                            </div>
                             <!-- end rex-etsy-api-settings__input-area -->
                        </div>
                        <!-- end rex-etsy-api-settings__input-field -->

                        <div class="rex-etsy-api-settings__input-field">
                            <div class="rex-etsy-api-settings__level-area">
                                   <label for="fname" class="rex-etsy-api-settings__width-modify">Minimum processing days:</label>
                                   <span>*</span>
                                    <span class="etsy-tooltip">
                                            <span class="icon">
                                                <img src="<?php echo plugin_dir_url(__DIR__) . 'icon/info-circle.png'; ?>"
                                                        alt="info-circle">
                                            </span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores mollitia omnis eveniet!</p>
                                    </span>
                            </div>
                            <!-- end rex-etsy-api-settings__level-area -->

                            <div class="rex-etsy-api-settings__input-area">
                                <input type="number" name="min_processing_days"  id="min_processing_days"
                                    placeholder="Min. Days">
                                <p id="validate_min_processign_days" style="font-size: 13px;color: red"></p>
                            </div>
                             <!-- end rex-etsy-api-settings__input-area -->

                        </div>
                        <!-- end rex-etsy-api-settings__input-field -->

                        <div class="rex-etsy-api-settings__input-field">
                            <div class="rex-etsy-api-settings__level-area">
                                <label for="fname" class="rex-etsy-api-settings__width-modify">Maximum processing days:</label>
                                <span>*</span>
                                    <span class="etsy-tooltip">
                                                <span class="icon">
                                                    <img src="<?php echo plugin_dir_url(__DIR__) . 'icon/info-circle.png'; ?>"
                                                            alt="info-circle">
                                                </span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores mollitia omnis eveniet!</p>
                                    </span>
                            </div>
                            <!-- end rex-etsy-api-settings__level-area -->
                            
                            <div class="rex-etsy-api-settings__input-area">
                                <input type="number" name="max_processing_days"  id="max_processing_days"
                                    placeholder="Max. Days">
                                <p id="validate_max_processign_days" style="font-size: 13px;color: red"></p>
                            </div>
                             <!-- end rex-etsy-api-settings__input-field -->
                        </div>
                        <!-- end rex-etsy-api-settings__input-field -->

                        <div class="rex-etsy-api-settings__button-area">
                            <button class="btn-default-bg" id="create_shippping_id">Generate</button>
                        </div>
                        <!-- end rex-etsy-api-settings__button-area -->

                        <p id="generate_shipping_template_id"></p>
                    </div>
                <!-- rex-shipping-template-id generation ends-->

                <div class="rex-etsy-api-settings__shipping-table">
                    <h2 class="rex-etsy-api-settings__title"><?php esc_html_e('Generate Shipping ID', 'etsy-product-feed'); ?></h2>
                    <?php
                    if (!empty($shipping_infos)) {
                        ?>
                        <div id="shipping_table" class="rex-etsy-api-settings__table-content">
                            <table>
                                <tr>
                                    <th>Shipping title</th>
                                    <th>Shipping template id</th>
                                    <th>Action</th>
                                </tr>
                                <?php
                                for ($i = 0; $i < sizeof($shipping_infos); $i++) {
                                    ?>
                                    <tr>
                                        <td><?php echo (isset($shipping_infos[$i]['shipping_title'])) ? $shipping_infos[$i]['shipping_title'] : ""; ?></td>
                                        <td><?php echo (isset($shipping_infos[$i]['shipping_template_id'])) ? $shipping_infos[$i]['shipping_template_id'] : ""; ?></td>
                                        <td><input type="hidden"
                                                   value="<?php echo (isset($shipping_infos[$i]['shipping_template_id'])) ? $shipping_infos[$i]['shipping_template_id'] : ""; ?>"
                                                   class="delete_shipping_id">
                                            <button class="delete_shipping">
                                                <svg width="22px" height="22px"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke="currentColor" color="red">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                            <!-- <button class="delete_shipping">
                                                delete
                                            </button> -->
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div id="shipping_table">
                            <?php
                            echo "No shipping infos"
                            ?>
                        </div>

                        <?php
                    }
                    ?>

                    <p id="refresh_result"></p>
                    <p id="shipping_id_delete_status"></p>
                </div>
                <!-- rex-etsy shipping table -->
            </div>
        </div>
        <!-- rex-general__block-wrapper.end #tab2 -->
    </div>

        <div id="tab3" class="tab-content block-wrapper">
            <div class="rex-etsy-api-settings__send-product">
                <?php
                //get token credentials
                $token_credentials = get_option('istokencreated');
                //check if user authenticated or not
                if ($token_credentials) {
                    //get product ids
                    $product_ids = get_posts(array(
                        'post_type' => array('product', 'variation'),
                        'numberposts' => -1,
                        'post_status' => 'publish',
                        'fields' => 'ids',
                    ));
                    $ids = serialize($product_ids);
                    ?>
                    <div class="rex-etsy-api-settings__product-from-area">
                        <h4 class="rex-show-product-wrapper__title"><?php esc_html_e('Send Product To Etsy', 'etsy-product-feed'); ?></h4>
                        <div class="rex-show-product__select-box">
                          <div class="rex-etsy-api-settings__level-area">
                                <label for="who made">Products:</label>
                                <span>*</span>
                                <span class="etsy-tooltip">
                                                    <span class="icon">
                                                        <img src="<?php echo plugin_dir_url(__DIR__) . 'icon/info-circle.png'; ?>"
                                                            alt="check">
                                                    </span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores mollitia omnis eveniet!</p>
                                                </span>
                           </div>

                           <div class="rex-etsy-api-settings__input-area">
                                <select name="page" id="select_all_selected">
                                    <option value="send_all">Send All Products</option>
                                    <option value="send_selected">Send Selected Products</option>
                                </select>
                          </div>

                        </div>
                    </div>

                    <div class="rex-etsy-api-settings__product-from-area" >
                        <div class="rex-show-product__select-box">

                            <div class="rex-show-product__search-btn-area" id="search_field" style="display: none">
                                <h6 class="rex-show-product-wrapper__title"><?php esc_html_e('Select your products', 'etsy-product-feed'); ?></h6>
                                <select data-security="<?php echo wp_create_nonce('search-products'); ?>" multiple
                                        class="bc-product-search">
                                </select>
                            </div>

                            <br>
                            <div class="rex-etsy-api-settings__level-area">
                                <label for="who made">who made:</label>
                                <span>*</span>
                                <span class="etsy-tooltip">
                                    <span class="icon">
                                        <img src="<?php echo plugin_dir_url(__DIR__) . 'icon/info-circle.png'; ?>" alt="check">
                                    </span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores mollitia omnis eveniet!</p>
                                </span>
                            </div>
                            <!-- end rex-etsy-api-settings__level-area -->

                            <div class="rex-etsy-api-settings__input-area">
                                <select name="who_made" id="who_made">
                                    <option value="i_did">i did</option>
                                    <option value="collective">colectitive</option>
                                    <option value="someone_else">someone else</option>
                                </select>
                                <p id="validate_who_made" style="font-size: 13px;color: red"></p>
                            </div>
                            <!-- end rex-etsy-api-settings__input-field -->

                        </div>
                        <!-- end rex-show-product__select-box -->

                        <div class="rex-show-product__select-box">
                            <div class="rex-etsy-api-settings__level-area">
                                <label for="when made">when made:</label>
                                <span>*</span>
                                <span class="etsy-tooltip">
                                    <span class="icon">
                                        <img src="<?php echo plugin_dir_url(__DIR__) . 'icon/info-circle.png'; ?>"
                                            alt="check">
                                    </span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores mollitia omnis eveniet!</p>
                                </span>
                            </div>
                            <!-- end rex-etsy-api-settings__level-area -->

                            <div class="rex-etsy-api-settings__input-area">
                                <select name="when_made" id="when_made">
                                    <option value="made_to_order">made_to_order</option>
                                    <option value="2020_2020">2020_2020</option>
                                    <option value="2010_2019">2010_2019</option>
                                    <option value="2001_2009">2001_2009</option>
                                    <option value="before_2001">before_2001</option>
                                    <option value="2000_2000">2000_2000</option>
                                    <option value="1990s">1990s</option>
                                    <option value="1980s">1980s</option>
                                    <option value="1970s">1970s</option>
                                    <option value="1950s">1950s</option>
                                    <option value="1940s">1940s</option>
                                    <option value="1930s">1930s</option>
                                    <option value="1910s">1910s</option>
                                    <option value="1900s">1900s</option>
                                    <option value="1800s">1800s</option>
                                    <option value="1700s">1700s</option>
                                    <option value="before_1700">before_1700</option>
                                </select>
                                <p id="validate_when_made" style="font-size: 13px;color: red"></p>
                            </div>
                            <!-- end rex-etsy-api-settings__input-field -->
                        </div>
                        <!-- end rex-show-product__select-box -->

                        <div class="rex-show-product__select-box">
                            <div class="rex-etsy-api-settings__level-area">
                                <label>Shipping ID:</label>
                                <span>*</span>
                                <span class="etsy-tooltip">
                                        <span class="icon">
                                            <img src="<?php echo plugin_dir_url(__DIR__) . 'icon/info-circle.png'; ?>"
                                                alt="check">
                                        </span>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores mollitia omnis eveniet!</p>
                                </span>
                            </div>
                            <!-- end rex-etsy-api-settings__level-area -->

                            <div class="rex-etsy-api-settings__input-area">
                                <select name="years" id="shipping_template_id">
                                    <?php
                                    foreach ($shipping_template_id as $key => $val) {
                                        echo "<option value=" . $val . ">" . $val . "</option>";
                                    }
                                    ?>
                                </select>
                                <p id="validation_shipping_id" style="font-size: 13px;color: red"></p>
                            </div>
                            <!-- end rex-etsy-api-settings__input-field -->

                        </div>
                        <!-- end rex-show-product__select-box -->

                        <div class="rex-show-product__select-box">
                            <div class="rex-etsy-api-settings__level-area">
                                <label>Category ID:</label>
                                <span>*</span>
                                <span class="etsy-tooltip">
                                    <span class="icon">
                                                        <img src="<?php echo plugin_dir_url(__DIR__) . 'icon/info-circle.png'; ?>"
                                                            alt="check">
                                                    </span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores mollitia omnis eveniet!</p>
                                </span>
                            </div>
                            <!-- end rex-etsy-api-settings__level-area -->

                            <div class="rex-etsy-api-settings__input-area">
                                <input type="text"  id="texonomy_id">
                                <p id="validate_texonomy_id" style="font-size: 13px;color: red"></p>
                            </div>
                            <!-- end rex-etsy-api-settings__input-field -->

                        </div>
                        <!-- end rex-show-product__select-box -->

                        <div class="rex-show-product__sending-data-row" id="send_all_product_button">
                            <!--div starts for sending all  data-->
                            <div>
                                <!--send all data -->
                                <input type="hidden" name="result[]"  value="<?php echo $ids; ?>"
                                       class="product_ids">
                                <button class="btn-default-bg" id="send_all_data">Send products</button>
                                <p id="success_mesage_all_data" style="font-size: 17px"></p>
                            </div>
                            <!--div ends for sending all  data-->

                        </div>

                        <div class="rex-show-product__sending-data-row" id="send_selected_product_button" style="display: none">
                            <div class="rex-show-product__send-btn-area">
                                <button class="btn-default" id="send_selectd_data">Send selected products</button>
                                <p id="success_mesage" style="font-size: 17px"></p>
                            </div>
                        </div>
                    </div>

                    <?php
                } else {
                    echo '<div class="rex-show-product-authorization">';
                    echo '<p> Please complete your authorization first</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <!-- rex-general__block-wrapper.end #tab3-->

        <div id="tab4" class="tab-content block-wrapper">
            <div class="rex-etsy-api-setting__option-tab">

                <h2 class="rex-etsy-api-settings__title"><?php esc_html_e('Other options', 'etsy-product-feed'); ?></h2>

                <?php
                //get token credentials
                $token_credentials = get_option('istokencreated');
                //check if user authenticated or not
                if ($token_credentials) {
                    //get product ids
                    $product_ids = get_posts(array(
                        'post_type' => array('product', 'variation'),
                        'numberposts' => -1,
                        'post_status' => 'publish',
                        'fields' => 'ids',
                    ));

                    $ids = serialize($product_ids);
                    ?>


                    <div class="rex-etsy-api-setting__option-tab-content">

                        <!--div starts for sending all data clare batch-->

                        <div class="rex-etsy-api-setting__clear-merchant">
                            <h4 class="rex-show-product-wrapper__title"><?php esc_html_e('Get Status', 'etsy-product-feed'); ?></h4>
                            <button class="btn-default" onClick="window.location='admin.php?page=etsy-api-settings'">
                                Status
                            </button>
                            <p id="batch_clear_msg" style="font-size: 17px"></p>
                        </div>

                        <!-- <div class="rex-etsy-api-setting__clear-merchant">
                            <h4 class="rex-show-product-wrapper__title"><?php esc_html_e('Delete all product', 'etsy-product-feed'); ?></h4>
                            <button id="delete_all_data" class="btn-red">
                                <svg class="delete_shipping" width="22px" height="22px" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor" color="red">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                            <input type="hidden" name="result[]" value="<?php echo $ids; ?>" class="product_ids">
                            <h4 id="show_delete_status"></h4>
                        </div> -->

                        <!--rex-etsy-api-setting__clear-merchant-->

                        <div class="rex-etsy-api-setting__clear-merchant">
                            <h4 class="rex-show-product-wrapper__title"><?php esc_html_e('Clear batch', 'etsy-product-feed'); ?></h4>
                            <button class="btn-default" id="clear_batch">Clear</button>
                            <p id="batch_clear_msg" style="font-size: 17px"></p>
                        </div>

                        <!-- rex-etsy-api-setting__clear-merchant-->

                        <!-- <div class="rex-etsy-api-setting__clear-merchant">
                            <h4 class="rex-show-product-wrapper__title"><?php esc_html_e('Get Status', 'etsy-product-feed'); ?></h4>
                            <button class="btn-default" onClick="window.location='admin.php?page=etsy-api-settings'">
                                Status
                            </button>
                            <p id="batch_clear_msg" style="font-size: 17px"></p>
                        </div> -->

                        <!-- rex-etsy-api-setting__clear-merchant-->


                        <!--show sending status ends-->

                    </div>


                    <!-- .rex-show-product-wrapper -->

                    <?php
                } else {
                    echo '<div class="rex-show-product-authorization">';
                    echo '<p> Please complete your authorization first</p>';
                    echo '</div>';
                }

                ?>
            </div>
        </div>
        <!-- rex-general__block-wrapper.end #tab4 -->
    </div>
</div>

<!--<script>-->
<!--    function myFunction() {-->
<!--        alert("You pressed a key inside the input field");-->
<!--    }-->
<!--</script>-->
