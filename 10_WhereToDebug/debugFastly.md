# Debug Fastly


## Staging

````bash
FASTLY_API_TOKEN_STG=""

FASTLY_SERVICE_ID_STG=""

# Get current version 
curl -s -H "Fastly-Key: $FASTLY_API_TOKEN_STG" "https://api.fastly.com/service/$FASTLY_SERVICE_ID_STG" | jq '.versions[] | select(.active == true)'

# Image variables
CATALOG_IMAGE_URL="https://MISITE.COM/media/catalog/
/product/3/2/329041_jipnzaelm9delptc.jpg"
IMAGE_PARAMS="?width=300&height=300&fit=bounds&format=webp&dpr=1"

# Download current VCL
VCL_VERSION_STG=11
curl -H "Fastly-Key: $FASTLY_API_TOKEN_STG" "https://api.fastly.com/service/$FASTLY_SERVICE_ID_STG/version/$VCL_VERSION_STG/generated_vcl"  -o "fastly_$VCL_VERSION_STG.vcl"


````

## Production

