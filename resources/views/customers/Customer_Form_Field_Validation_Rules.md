# Customer Form Field Validation Rules

This document describes the validation applied to each field in the Customer Bank Details form.

| Field Name              | Requirement | Type / Format    | Additional Rules                   | Example / Notes               |
| ----------------------- | ----------- | ---------------- | ---------------------------------- | ----------------------------- |
| **bank_name**           | Required    | String           | Max length 150                     | Bank name as per records      |
| **account_no**          | Required    | Numeric digits   | Between 9–18 digits                | e.g. `123456789012`           |
| **account_create_date** | Required    | Date             | Valid date format (YYYY-MM-DD)     |                               |
| **customer_nm**         | Required    | String           | Max 150 chars                      | Full name of customer         |
| **mobile_no**           | Required    | 10-digit number  | Must be unique in customers table  |                               |
| **alternate_no**        | Optional    | 10-digit number  | Must be different from `mobile_no` |                               |
| **addr_details**        | Optional    | String           | Max 255 chars                      | Full address                  |
| **location**            | Optional    | String           | Max 100 chars                      | Town or branch                |
| **aadhaar_no**          | Optional    | String           | Max 20 chars; Unique               |                               |
| **document_nm**         | Optional    | String           | Max 150 chars                      | Document name (if applicable) |
| **pan_no**              | Optional    | String           | Max 20 chars                       |                               |
| **apy_status**          | Optional    | String           |                                    |                               |
| **apy_active_date**     | Optional    | Date             |                                    |                               |
| **pmjjby_status**       | Optional    | String           |                                    |                               |
| **pmjjby_active_date**  | Optional    | Date             |                                    |                               |
| **pmsby_status**        | Optional    | String           |                                    |                               |
| **gender**              | Optional    | String           | Max 10 chars                       | Male / Female / Other         |
| **age**                 | Optional    | Integer          | Between 0–120                      |                               |
| **atm_status**          | Optional    | String           |                                    |                               |
| **passbk_status**       | Optional    | String           |                                    |                               |
| **image_attachment**    | Optional    | Image (JPEG/JPG) | Max size 2 MB                      | Passport photo or scanned ID  |
| **pdf_attachment**      | Optional    | PDF Document     | Max size 4 MB                      | Supporting document           |

### Notes

-   Fields marked **Required** must be filled.
-   Upload fields have strict type and size restrictions.
-   Mobile and alternate mobile numbers cannot be identical.
