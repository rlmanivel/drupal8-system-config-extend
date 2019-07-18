REST UI
=======

This module to update Site Information Section and Rest resource Implementation for Basic Pages

Installation
============

Once the module 'Site Custom Configurations' has been installed, 

- You can config/update the Site API Key in {site_url}/admin/config/system/site-information

- You can also access Basic Page rest endpoint by passing 2 arguments(Site APIKey, Node id)

    Rest endpoint Example URL pattern: https://example.com/page_json/{Site_APIKey}/{Node_ID}
    
    Note: This Rest endpoint currently can be accessed through below authentications.
        - cookie
        - basic_auth