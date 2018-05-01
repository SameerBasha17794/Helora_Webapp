<?php

/**
 * @class       GMEX_Easy_Payment
 * @version	1.0.0
 * @package	easy-payment
 * @category	Class
 * @author      mbj-webdevelopment <mbjwebdevelopment@gmail.com>
 */
class GMEX_Easy_Payment {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      GMEX_Easy_Payment_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the Dashboard and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct() {

        $this->plugin_name = 'easy-payment';
        $this->version = '1.1.7';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();

        //add_filter('wp_mail_content_type', array($this, 'set_html_content_type'));
        add_action('init', array($this, 'add_endpoint'), 0);
        add_action('parse_request', array($this, 'handle_api_requests'), 0);
        add_action('easy_payment_send_notification_mail', array($this, 'easy_payment_send_notification_mail'), 10, 1);

        add_action('easy_payment_api_ipn_handler', array($this, 'easy_payment_api_ipn_handler'));
        $prefix = is_network_admin() ? 'network_admin_' : '';
        add_filter("{$prefix}plugin_action_links_" . PPW_PLUGIN_BASENAME, array($this, 'easy_payment_plugin_action_links'), 10, 4);

        add_filter('widget_text', 'do_shortcode');
    }

    public function easy_payment_plugin_action_links($actions, $plugin_file, $plugin_data, $context) {
        $custom_actions = array(
            'configure' => sprintf('<a href="%s">%s</a>', admin_url('options-general.php?page=easy-payment'), __('Configure', 'easy-payment')),
            'docs' => sprintf('<a href="%s" target="_blank">%s</a>', 'https://www.premiumdev.com/product/easy-paypal-payment/', __('Docs', 'donation-button')),
            'support' => sprintf('<a href="%s" target="_blank">%s</a>', 'http://wordpress.org/support/plugin/easy-payment/', __('Support', 'easy-payment')),
            'review' => sprintf('<a href="%s" target="_blank">%s</a>', 'http://wordpress.org/support/view/plugin-reviews/easy-payment', __('Write a Review', 'easy-payment')),
        );

        return array_merge($custom_actions, $actions);
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - GMEX_Easy_Payment_Loader. Orchestrates the hooks of the plugin.
     * - GMEX_Easy_Payment_i18n. Defines internationalization functionality.
     * - GMEX_Easy_Payment_Admin. Defines all hooks for the dashboard.
     * - GMEX_Easy_Payment_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-easy-payment-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-easy-payment-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the Dashboard.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-easy-payment-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-easy-payment-public.php';

        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/class-easy-payment-list.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-easy-payment-mailchimp-helper.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-easy-logger.php';


        $this->loader = new GMEX_Easy_Payment_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the GMEX_Easy_Payment_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale() {

        $plugin_i18n = new GMEX_Easy_Payment_i18n();
        $plugin_i18n->set_domain($this->get_plugin_name());

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Register all of the hooks related to the dashboard functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {

        $plugin_admin = new GMEX_Easy_Payment_Admin($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        $this->loader->add_filter('woocommerce_paypal_args', $plugin_admin, 'easy_payment_woocommerce_standard_parameters', 99, 1);
        $this->loader->add_action('media_buttons', $plugin_admin, 'easy_add_my_media_button');
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks() {

        $plugin_public = new GMEX_Easy_Payment_Public($this->get_plugin_name(), $this->get_version());


        //$this->loader->add_filter('widget_text', $plugin_public, 'do_shortcode');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    GMEX_Easy_Payment_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }

    public function handle_api_requests() {
        global $wp;

        if (isset($_GET['action']) && $_GET['action'] == 'ipn_handler') {
            $wp->query_vars['GMEX_Easy_Payment'] = $_GET['action'];
        }

        // easy-payment endpoint requests
        if (!empty($wp->query_vars['GMEX_Easy_Payment'])) {

            // Buffer, we won't want any output here
            ob_start();

            // Get API trigger
            $api = strtolower(esc_attr($wp->query_vars['GMEX_Easy_Payment']));

            // Trigger actions
            do_action('easy_payment_api_' . $api);

            // Done, clear buffer and exit
            ob_end_clean();
            die('1');
        }
    }

    /**
     * add_endpoint function.
     *
     * @access public
     * @since 1.0.0
     * @return void
     */
    public function add_endpoint() {

        // easy-payment API for PayPal gateway IPNs, etc
        add_rewrite_endpoint('GMEX_Easy_Payment', EP_ALL);
    }

    public function easy_payment_api_ipn_handler() {

        /**
         * The class responsible for defining all actions related to paypal ipn listener 
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-easy-payment-paypal-listner.php';
        $GMEX_Easy_Payment_PayPal_listner = new GMEX_Easy_Payment_PayPal_listner();

        /**
         * The check_ipn_request function check and validation for ipn response
         */
        if ($GMEX_Easy_Payment_PayPal_listner->check_ipn_request()) {
            $GMEX_Easy_Payment_PayPal_listner->successful_request($IPN_status = true);
        } else {
            $GMEX_Easy_Payment_PayPal_listner->successful_request($IPN_status = false);
        }
    }

    public function set_html_content_type() {
        return 'text/html';
    }

    public function easy_payment_send_notification_mail($posted) {

        $log = new Easy_Payment_Logger();

        $template = get_option('easy_payments_email_body_text');
        $template_value = isset($template) ? $template : get_option('easy_payments_email_body_text_pre');
        $parse_templated = $this->easy_payment_template_vars_replacement($template_value, $posted);
        $from_name = get_option('easy_payments_email_from_name');
        $from_name_value = isset($from_name) ? $from_name : 'From';
        $sender_address = get_option('easy_payments_email_from_address');
        $sender_address_value = isset($sender_address) ? $sender_address : get_option('admin_email');


        if (isset($from_name_value) && !empty($from_name_value)) {
            $headers = "From: " . $from_name_value . " <" . $sender_address_value . ">";
        }
        if (isset($posted['payer_email']) && !empty($posted['payer_email'])) {
            $subject = get_option('easy_payments_email_subject');
            $subject_value = isset($subject) ? $subject : 'Thank you for your payment';
            $enable_admin = get_option('easy_payments_admin_notification');

            $recipients_email_arr = explode(',', trim(get_option('easy_payments_recipients_notification')));

            $admin_email = "";
            if ($enable_admin == 'yes') {
                $admin_email = get_option('admin_email');
            }

            $payer_email = $posted['payer_email'];
            if (isset($admin_email) && !empty($admin_email)) {
                array_push($recipients_email_arr, $admin_email);
            }
            if (isset($payer_email) && !empty($payer_email)) {
                array_push($recipients_email_arr, $payer_email);
            }

            // Custom - email to doctor, from which we are buying the procedure
            // Get doctor ID
            $allText = $posted['item_name'];
            $findDoctorID = ", DOCTOR ID:";
            $findProcedureSKU = ", SKU:"; 

            $startPosition = strpos ($allText, $findDoctorID) + strlen($findDoctorID);
            if (strpos($allText, $findDoctorID) !== false) {
                $endPosition = strpos($allText, $findProcedureSKU, $startPosition);
                $getDoctorID = substr($allText, $startPosition, $endPosition - $startPosition);
            }

            $doctorEmail = xprofile_get_field_data('Email', $getDoctorID);

            $doctor_email = $doctorEmail;
            if (isset($admin_email) && !empty($admin_email)) {
                array_push($recipients_email_arr, $admin_email);
            }
            if (isset($doctor_email) && !empty($doctor_email)) {
                array_push($recipients_email_arr, $doctor_email);
            }
            // Custom END

            if (isset($headers) && !empty($headers)) {
                $this->easy_payment_send_recipients_notification_mail($recipients_email_arr, $subject_value, $template_value, $headers, $posted);
            } else {
                $this->easy_payment_send_recipients_notification_mail($recipients_email_arr, $subject_value, $parse_templated, '');
            }
        }
    }

    public static function easy_payment_send_recipients_notification_mail($recipients_email_arr, $subject_value, $template_value, $headers, $posted) {

        // Custom
        $allText = $posted['item_name'];
        $findPatientID = "PATIENT ID:";
        $findDoctorID = ", DOCTOR ID:";
        $findProcedureSKU = ", SKU:"; 
        $findCouponCode = ", COUPON CODE:";
        $infoEND = "END";

        // Get patient ID
        $startPosition = strpos ($allText, $findPatientID) + strlen($findPatientID);
        if (strpos($allText, $findPatientID) !== false) {
            $endPosition = strpos($allText, $findDoctorID, $startPosition);
            $getPatientID = substr($allText, $startPosition, $endPosition - $startPosition);
        }

        // Get doctor ID
        $startPosition = strpos ($allText, $findDoctorID) + strlen($findDoctorID);
        if (strpos($allText, $findDoctorID) !== false) {
            $endPosition = strpos($allText, $findProcedureSKU, $startPosition);
            $getDoctorID = substr($allText, $startPosition, $endPosition - $startPosition);
        }

        // Get procedure SKU
        $startPosition = strpos ($allText, $findProcedureSKU) + strlen($findProcedureSKU);
        if (strpos($allText, $findProcedureSKU) !== false) {
            $endPosition = strpos($allText, $findCouponCode, $startPosition);
            $getProcedureSKU = substr($allText, $startPosition, $endPosition - $startPosition);
        }

         // Get coupon code
        $startPosition = strpos ($allText, $findCouponCode) + strlen($findCouponCode);
        if (strpos($allText, $findCouponCode) !== false) {
            $endPosition = strpos($allText, $infoEND, $startPosition);
            $getCouponCode = substr($allText, $startPosition, $endPosition - $startPosition);
        }


        // Get procedures info
        global $wpdb;
        $currentCategoryINFO = $wpdb->get_row("SELECT * FROM hea_bp_xprofile_fields WHERE sku = '".$getProcedureSKU."'", ARRAY_A);

        // Doctor info
        $doctorFirstName = xprofile_get_field_data('First Name', $getDoctorID);
        $doctorLastName = xprofile_get_field_data('Last Name', $getDoctorID);
        $doctorPhone = xprofile_get_field_data('Office Phone', $getDoctorID);
        $doctorEmail = xprofile_get_field_data('Email', $getDoctorID);
        $doctorAddressStreet = xprofile_get_field_data('Office Address / Street', $getDoctorID);
        $doctorAddressCity = xprofile_get_field_data('Office Address / City', $getDoctorID);
        $doctorAddressState = xprofile_get_field_data('Office Address / State', $getDoctorID);
        $doctorAddressZIP = xprofile_get_field_data('Office Address / ZIP code', $getDoctorID);
        $doctorNameFirstSymbol = mb_substr($doctorFirstName, 0, 1);
        $doctorLastNameFirstSymbol = mb_substr($doctorLastName, 0, 1);

        // Patient info
        $patientFirstName = xprofile_get_field_data('First Name', $getPatientID);
        $patientLastName = xprofile_get_field_data('Last Name', $getPatientID);
        $patientPhone = xprofile_get_field_data('Phone', $getPatientID);


        $recipients_email_arr = array_unique($recipients_email_arr);
        //$log->add('easy_payment_ipn_mail', print_r($recipients_email_arr,true));
        if (!empty($recipients_email_arr)) {
            foreach ($recipients_email_arr as $recipient_email) {

                // Email to patient
                $get_payer_email = $posted['payer_email'];
                $subject_value = "Thank you for reserving your price";
                $template_value = '
	                <p>Dear '.$posted['first_name'].' '.$posted['last_name'].',</p>

	                	<p>Congratulations! You reserve your price for<br>
                        <b>'.$currentCategoryINFO['name'].'</b></p>

                        <p>CPT: '.$currentCategoryINFO['cpt'].' - SKU: '.$getProcedureSKU.'</p>
                        with '.$doctorFirstName.' '.$doctorLastName.'<br>
                        <b>Your Coupon Number</b><br>
                        <span style="color: #FF7600;">'.$getCouponCode.'</span><br>

                        <p>The total price: $'.$currentCategoryINFO["healora_price"].'<br> 
                        The balance due to doctor: $'.$currentCategoryINFO["provider_price"].'</p>

                        <p>1. Make an appointment with the doctor:</br>
                        <b>'.$doctorPhone.', '.$doctorAddressStreet .' '.$doctorAddressCity.' '.$doctorAddressState.' '.$doctorAddressZIP.'</b><br>
                        2. Bring the Coupon Number with you<br>
                        3. Have the procedure done!</p>

						--<br>
						<p>Your PayPal transaction ID: '.$posted['txn_id'].'<br>
						PayPal payment date: '.$posted['payment_date'].'</p>
						--<br>

						<p>If you have any questions, please contact us – help@healora.com</p>

						Thank you,<br>
						'.get_option('blogname').', '.get_option('home').'
                ';

                if ($recipient_email == $get_payer_email ) {
                    try {
                        wp_mail($recipient_email, $subject_value, $template_value, $headers);
                    } catch (Exception $e) { 
                    }
                }
                // Email to patient END


                // Email to doctor
                $get_doctor_email = $doctorEmail;
                $subject_value = 'Healora Procedure '.$currentCategoryINFO['cpt'].'/'.$getProcedureSKU.'/'.$getProcedureSKU.$doctorLastNameFirstSymbol.$doctorNameFirstSymbol.'1 has been reserved';
                $template_value = '
	                 <p>Dear '.$doctorFirstName.' '.$doctorLastName.',</p>

                        <p>Congratulations! '.$patientFirstName.' '.$patientLastName.' reserved procedure<br>
                        <b>'.$currentCategoryINFO['name'].'</b></p>

                        <p>CPT: '.$currentCategoryINFO['cpt'].' - SKU: '.$getProcedureSKU.'</p>
                        <b>Patient Coupon Number</b><br>
                        <span style="color: #FF7600;">'.$getCouponCode.'</span><br>

                        <p>The balance due to doctor: $'.$currentCategoryINFO["provider_price"].'</p>

                        <p>Patient contact information: </br>
                        <b>'.$patientPhone.'</b></p>

                        --<br>
                        <p>PayPal transaction ID: '.$posted['txn_id'].'<br>
                        PayPal payment date: '.$posted['payment_date'].'</p>
                        --<br>

                        <p>If you have any questions, please contact us – help@healora.com</p>

                        Thank you,<br>
                        '.get_option('blogname').', '.get_option('home').'
                ';

                if ($recipient_email == $get_doctor_email ) {
                    try {
                        wp_mail($recipient_email, $subject_value, $template_value, $headers);
                    } catch (Exception $e) {
                    }   
                }
                // Email to doctor END


                // Email to admin
                $get_admin_email = get_option('admin_email');
                $subject_value = ''.$currentCategoryINFO['cpt'].'/'.$getProcedureSKU.'/'.$getProcedureSKU.$doctorLastNameFirstSymbol.$doctorNameFirstSymbol.'1 has been reserved';
                $template_value = '
						<p>'.$patientFirstName.' '.$patientLastName.' has successfully reserved procedure via Healora with doctor '.$doctorFirstName.' '.$doctorLastName.'.</p>

                        <p><b>'.$currentCategoryINFO['name'].'</b></p>

                        <p>CPT: '.$currentCategoryINFO['cpt'].' - SKU: '.$getProcedureSKU.'</p>
                        <b>Coupon Number</b><br>
                        <span style="color: #FF7600;">'.$getCouponCode.'</span><br>

                        <p>The total price: $'.$currentCategoryINFO["healora_price"].'<br> 
                        The balance due to doctor: $'.$currentCategoryINFO["provider_price"].'</p>

                        --<br>
                        <p>PayPal transaction ID: '.$posted['txn_id'].'<br>
                        PayPal payment date: '.$posted['payment_date'].'</p>
                        --<br>

                        Thank you,<br>
                        '.get_option('blogname').', '.get_option('home').'
                ';

                if ($recipient_email == $get_admin_email ) {
                    try {
                        wp_mail($recipient_email, $subject_value, $template_value, $headers);
                    } catch (Exception $e) {
                    }   
                }
                // Email to doctor END
                // Custom END
            }
        }
    }


    /*public static function easy_payment_send_recipients_notification_mail($recipients_email_arr, $subject_value, $parse_templated, $headers) {

        $recipients_email_arr = array_unique($recipients_email_arr);
        //$log->add('easy_payment_ipn_mail', print_r($recipients_email_arr,true));
        if (!empty($recipients_email_arr)) {
            foreach ($recipients_email_arr as $recipient_email) {
                try {
                    wp_mail($recipient_email, $subject_value, $parse_templated, $headers);
                } catch (Exception $e) {
                    
                }
            }
        }
    }*/




    public function easy_payment_template_vars_replacement($template, $posted) {

        $to_replace = array(
            'blog_url' => get_option('siteurl'),
            'home_url' => get_option('home'),
            'blog_name' => get_option('blogname'),
            'blog_description' => get_option('blogdescription'),
            'admin_email' => get_option('admin_email'),
            'date' => date_i18n(get_option('date_format')),
            'time' => date_i18n(get_option('time_format')),
            'txn_id' => $posted['txn_id'],
            'receiver_email' => $posted['receiver_email'],
            'payment_date' => $posted['payment_date'],
            'first_name' => $posted['first_name'],
            'last_name' => $posted['last_name'],
            'mc_currency' => $posted['mc_currency'],
            'mc_gross' => $posted['mc_gross'], 

            // Custom
            'procedure_total_price' => $getTotalPrice,
            'procedure_valance_due_at_visit' => $getBalanceDueAtVisit,
            'procedure_fee_payed' => $getFeePayed,
            'procedure_coupon_code' => $getCouponCode,
            'procedure_provider_info' => $getProviderInfo,
            'procedure_description' => $getProcedureDescription,
            'patient_email' => $posted['payer_email'],
            'doctorOfficePhone' => $getDoctorOfficePhone,
            'doctorOfficeEmail' => $getDoctorOfficeEmail, 
            'doctorOfficeCity' => $getDoctorOfficeCity
            // Custom END
        );

        foreach ($to_replace as $tag => $var) {

            $template = str_replace('%' . $tag . '%', $var, $template);
        }

        return $template;
    }

}