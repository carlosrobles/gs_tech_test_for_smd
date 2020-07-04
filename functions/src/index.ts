export const partnerInvoice = async (event: any = {}): Promise<any> => {
    console.log('Hello World mam!');
    const response = JSON.stringify(event, null, 2);
    console.log(response);
    return response;
}