export const pushItemBundleToMagento = (event: any = {}, context: any) => {
    event.Records.forEach(record => {
            const body = JSON.parse(record.body);
            console.log(body)
        }
    );
    return null;
}