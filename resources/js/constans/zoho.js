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
    },
}


export const zohoScopes = zoho_scopes.permissions;

export const defaultScopes = [
    "ZohoCRM.bulk.ALL",
    "ZohoCRM.coql.READ",
    "ZohoCRM.snippets.ALL",
    "ZohoCRM.settings.ALL",
    "ZohoCRM.settings.fields.ALL",
    "ZohoCRM.settings.layouts.ALL",
    "ZohoCRM.settings.snippets.ALL",
    "ZohoCRM.settings.profiles.ALL",
    "ZohoCRM.settings.custom_views.ALL",
    "ZohoCRM.users.ALL",
    "ZohoCreator.bulk.CREATE",
    "ZohoCreator.bulk.READ",
    "ZohoCreator.dashboard.READ",
    "ZohoCreator.meta.application.READ",
    "ZohoCreator.meta.form.READ",
    "ZohoCreator.report.DELETE",
    "ZohoCreator.report.UPDATE",
    "ZohoCreator.report.READ",
    "ZohoCreator.report.CREATE",
    "ZohoCreator.form.CREATE"
];
