<?php
# MantisBT - a php based bugtracking system

# MantisBT is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 2 of the License, or
# (at your option) any later version.
#
# MantisBT is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with MantisBT.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package MantisBT
 * @copyright Copyright (C) 2000 - 2002  Kenzaburo Ito - kenito@300baud.org
 * @copyright Copyright (C) 2002 - 2014  MantisBT Team - mantisbt-dev@lists.sourceforge.net
 * @link http://www.mantisbt.org
 */

# This sample file contains the essential files that you MUST
# configure to your specific settings.  You may override settings
# from config_defaults_inc.php by uncommenting the config option
# and setting its value in this file.

# Rename this file to config_inc.php after configuration.

# In general the value OFF means the feature is disabled and ON means the
# feature is enabled.  Any other cases will have an explanation.

# Look in http://www.mantisbt.org/docs/ or config_defaults_inc.php for more
# detailed comments.

$cul_ini_array = parse_ini_file('cul_config.ini');

# --- Database Configuration ---
$g_hostname      = $cul_ini_array['db_host'];   # 'localhost' doesn't want to work for some reason
$g_db_username   = $cul_ini_array['db_user'];
$g_db_password   = $cul_ini_array['db_pass'];
$g_database_name = $cul_ini_array['db_database'];
$g_db_type       = 'mysql';

# --- Anonymous Access / Signup ---
$g_allow_signup				= ON;
$g_allow_anonymous_login	= OFF;
$g_anonymous_account		= '';

# --- Email Configuration ---
$g_phpMailer_method		= PHPMAILER_METHOD_MAIL; # or PHPMAILER_METHOD_SMTP, PHPMAILER_METHOD_SENDMAIL
$g_smtp_host			= 'localhost';			# used with PHPMAILER_METHOD_SMTP
$g_smtp_username		= '';					# used with PHPMAILER_METHOD_SMTP
$g_smtp_password		= '';					# used with PHPMAILER_METHOD_SMTP
$g_administrator_email  = 'cjl10@cornell.edu';
$g_webmaster_email      = '';
$g_from_email           = 'cul-room-reservation@cornell.edu';	# the "From: " field in emails
$g_return_path_email    = 'cjl10@cornell.edu';	# the return address for bounced mail
$g_from_name			= 'OKU Room Reservation System';
$g_email_receive_own	= ON;
# $g_email_send_using_cronjob = OFF;

# --- Attachments / File Uploads ---
# $g_allow_file_upload	= ON;
# $g_file_upload_method	= DATABASE; # or DISK
# $g_absolute_path_default_upload_folder = ''; # used with DISK, must contain trailing \ or /.
$g_max_file_size		= 1048576;	# in bytes
# $g_preview_attachments_inline_max_size = 256 * 1024;
# $g_allowed_files		= '';		# extensions comma separated, e.g. 'php,html,java,exe,pl'
# $g_disallowed_files		= '';		# extensions comma separated

# --- Branding ---
$g_window_title			= 'OKU Room Reservation System';
$g_logo_image			= 'application_form/img/cul.gif';
# $g_favicon_image		= 'images/favicon.ico';

# --- Real names ---
# $g_show_realname = OFF;
# $g_show_user_realname_threshold = NOBODY;	# Set to access level (e.g. VIEWER, REPORTER, DEVELOPER, MANAGER, etc)

# --- Others ---
# $g_default_home_page = 'my_view_page.php';	# Set to name of page to go to after login

# mjc12: overrides of config_defaults_inc values

$g_default_timezone = 'America/New York';

$g_enable_profiles = OFF; # get rid of profile fields like Platform, OS, OS Version

# Fields to show on the bug view page 
$g_bug_view_page_fields = array (
  'id',
  #'project',
  #'category_id',
  #'view_state',
  'date_submitted',
  'last_updated',
  #'reporter',
  'handler',
  #'priority',
  #'severity',
  #'reproducibility',
  'status',
  #'resolution',
  #'projection',
  'eta',
  #'platform',
  #'os',
  #'os_version',
  #'product_version',
  #'product_build',
  #'target_version',
  #'fixed_in_version',
  'summary',
  'description',
  'additional_info',
  #'steps_to_reproduce',
  #'tags',
  'attachments',
  'due_date',
);

# --- anonymous login -----------
$g_allow_anonymous_login = ON;
$g_anonymous_account = 'anonymous';

# Custom status list
$g_status_enum_string				= '10:new,20:feedback,30:acknowledged,40:confirmed,50:closed';

# Custom status colors
$g_status_colors['new'] = '#FFFF33';
$g_status_colors['feedback'] = '#CCFFFF';  # This is actually 'pending'
$g_status_colors['acknowledged'] = '#33AA22'; # This is actually 'approved'
$g_status_colors['confirmed'] = '#FF3333'; # This is actually 'disapproved'

# --- set up email notifications ---
$g_notify_flags['new']['threshold_min'] = UPDATER;
$g_notify_flags['new']['threshold_max'] = MANAGER;
