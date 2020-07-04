export const partnerInvoice = async (event: any = {}): Promise<any> => {
    console.log('Hello World mam!');
    const response = JSON.stringify(event, null, 2);
    console.log(response);
    return response;
}

export const pushItemBundleToMagento = async (event: any = {}): Promise<any> => {
    console.log('Hello item bundle!');
    const response = JSON.stringify(event, null, 2);
    console.log(response);
    return response;
}