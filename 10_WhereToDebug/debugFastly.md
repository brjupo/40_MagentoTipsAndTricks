# Debug Fastly


## Staging

````bash
FASTLY_API_TOKEN_STG=""

FASTLY_SERVICE_ID_STG=""

# Get current version 
curl -s -H "Fastly-Key: $FASTLY_API_TOKEN_STG" "https://api.fastly.com/service/$FASTLY_SERVICE_ID_STG" | jq '.versions[] | select(.active == true)'

# Image variables
CATALOG_IMAGE_URL__STG="https://mysite.com/media/catalog/product/r/o/rojo3_8627be8c-1eb5-4b75-950c-a4e45b183382_h0htdrp7sq67kkm0.jpg"
IMAGE_PARAMS__STG="?width=300&height=300&fit=bounds&format=webp&dpr=1"

# Request Image Headers
curl -I -H "Fastly-Debug:1"  "$CATALOG_IMAGE_URL__STG$IMAGE_PARAMS__STG"

# Download current VCL
VCL_VERSION_STG=11
curl -H "Fastly-Key: $FASTLY_API_TOKEN_STG" "https://api.fastly.com/service/$FASTLY_SERVICE_ID_STG/version/$VCL_VERSION_STG/generated_vcl"  -o "stg_fastly_$VCL_VERSION_STG.vcl"


````

## Production


````bash
FASTLY_API_TOKEN_PROD=""

FASTLY_SERVICE_ID_PROD=""

# Get current version 
curl -s -H "Fastly-Key: $FASTLY_API_TOKEN_PROD" "https://api.fastly.com/service/$FASTLY_SERVICE_ID_PROD" | jq '.versions[] | select(.active == true)'

# Image variables
CATALOG_IMAGE_URL__PROD="https://mysite.com/media/catalog/product/r/o/rojo3_8627be8c-1eb5-4b75-950c-a4e45b183382_ugzikoeiyzqo6xqk.jpg"
IMAGE_PARAMS__PROD="?width=300&height=300&fit=bounds&format=webp&dpr=1"

# Request Image Headers
curl -I -H "Fastly-Debug:1"  "$CATALOG_IMAGE_URL__PROD$IMAGE_PARAMS__PROD"

# Download current VCL
VCL_VERSION_PROD=11
curl -H "Fastly-Key: $FASTLY_API_TOKEN_PROD" "https://api.fastly.com/service/$FASTLY_SERVICE_ID_PROD/version/$VCL_VERSION_PROD/generated_vcl"  -o "prod_fastly_$VCL_VERSION_PROD.vcl"


````


