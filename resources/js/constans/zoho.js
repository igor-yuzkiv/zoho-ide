import zoho_scopes from "@/constans/zoho_scopes.json";

export const dataCenters = {
    us: {
        'title'   : 'United States',
        'domain'  : '.com',
        'location': 'us',
    },
    eu: {
        'title'   : 'Europe',
        'domain'  : '.eu',
        'location': 'eu',
    },
    in: {
        'title'   : 'India',
        'domain'  : '.in',
        'location': 'in',
    },
    au: {
        'title'   : 'Australia',
        'domain'  : '.com.au',
        'location': 'au',
    },
    jp: {
        'title'   : 'Japan',
        'domain'  : '.jp',
        'location': 'jp',
    }
}

export const zohoScopes = zoho_scopes.permissions;
