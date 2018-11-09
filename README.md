# Rain2o_MultiselectSourceSample
This module exists as a sample for how to create a custom Product Attribute 
of Multiselect type using a custom source model. Used for testing purposes. 

## Getting Started
To install this module run the following.

    composer config repositories.rain2o-multiselectsourcesample git https://github.com/rain2o/magento2-Rain2o_MultiselectSourceSample.git
    composer require rain2o/multiselect-source-sample:~1.0
    bin/magento module:enable Rain2o_MultiselectSourceSample
    bin/magento setup:upgrade

To see the custom attribute go to Stores -> Attributes -> Product and search for "Multiselect Sample".

To use the attribute simply edit a product and assign one or more values and save.     
    
## Authors
* Joel Rainwater