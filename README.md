## Project description
* unable to host since the ec2 was not accessible after few min
* Considering only allowed partner in the database for invoicing.
    * http://127.0.0.1/?partner=moe
    * http://127.0.0.1/?partner=dm
    * http://127.0.0.1/?partner=bm
* Find import sample product file in `src/var`

## List of tasks before start the project
* Setup magento 1.9 with mysql
    * estimation - 3 hrs
    * actual - 4 hrs
* Refresh 4 years old magento 1.9 memories.
    * estimation - 4 hrs
    * estimation - 2 hrs
* Understand the project requirements.
    * estimation - 1 hrs
    * actual - 1 hrs
* Design the project and picture it
    * estimation - 3 hrs
    * actual - 2 hrs
* Spike on AWS SQS
    * estimation - 2 hrs
    * actual - 2 hrs
* Spike on AWS lambda function
    * estimation - 3 hrs
    * actual - 5 hrs
* Spike on AWS EC2
    * estimation - 2 hrs
    * actual - 1hr
* List all the task and estimate time with considering estimations can go wrong.
    * estimation - 1hrs
    * actual - 1 hrs

## System diagram
* This is the initial plan for this project, but since the lambda and sqs concepts are new, it took me lots of time to debug and fix issues, therefor i replaced the queue system with magento event observer.
* ![Architecture](/doc/Partner%20Invoice-Page-1.png)
#### Why a queue system?
* In future there is high possibility that we need to check available to promise items (ATP) with store's inventory. so with this architecture we can communicate with 3rd party system requests without delaying the ordering process.

## Pseudo code
#### Register partner in magento
```
if(cookie.partner != null && cookie.partner.isValid) {
    order.partner = cookie.partner
} else {
    order.partner = null;
}
```

#### Identify partner invoice item function
```
if(order.partner != null) {
    foreach(order.items as i => item) {
        if(i%2) {
            mark the item for main warehouse
        } else {
            mark the item for partner
        }
    }
} else {
    // cookie is invalid or not set
    mark all items for main warehouse
}
```

#### POST endpoint
```
generateInvoice(items);
generateShipment(items);
ack();
```

## Models
1. Partner model
```
id: int
display_name: string
unique_code: string
status: bool
```

## Decisions/Assumptions
* if the item index is odd, it goes to partner
* Main warehouse(MWH) and partner have access to orders.
* If partner cookie is invalid or not set, then all items goes to MWH

## List of tasks
1. Capture partner in magento
    * create a partner module
        * Estimated - 1hrs
        * actual - 1hrs
    * create partner schema
        * Estimated - 1hrs
        * actual - 1hrs
    * feed some partner data
        * Estimated - 1hrs
        * actual - 0.25hrs
    * create partner cookie
        * Estimated - 1hrs
        * actual - 1hrs
    * register partner cookie value with order
        * Estimated - 2hrs
        * actual - 2hrs
2. Publish new order event to AWS SQS
    * install AWS PHP SDK
        * Estimated - 0.25hrs
        * actual - 0.25hrs
    * create new order event observer
        * Estimated - 0.5hrs
        * actual - 0.5hrs
    * publish new order event to new-order-queue
        * Estimated - 2hrs
        * actual - 1.5hrs
3. Invoice partner
    * create a function to do invoice partner
        * Estimated - 1hrs
        * actual - 0 hrs(completed when doing the spike)
    * bundle the items based the pseudo code given above
        * Estimated - 2hrs
        * actual - 4hrs (debugging was the most time-consuming work)
    * publish the message to item-bundle queue
        * Estimated - 1hrs
        * actual - 0.5hrs
        * Issues
            * messages become bundle
            * need more understanding about sqs anf lambda to continue further work     
4. Push item bundle to magento endpoint
    * Status - Hold
5. Create invoice in magento based on item bundle message
    * Haven't done yet
6. Create shipment in magento based on item bundle message
    * Haven't done yet
7. Host magento on AWS EC2
    * Estimated - 2hrs
    * actual - 0hrs (Completed with the spike task)
    * Instance is unreachable after few minutes. 
8. Create infrastructure 
    * Estimated - 8hrs
    * actual - 0hrs (Completed with the spike task)
9. Create partner column in order grid
    * Estimated - 1hrs
    * actual - 1hrs
    * ![Order Grid](/doc/order-grid.png)
    * ![Order Items](/doc/order-items.png)

## Commands used
* Infrastructure
    * terraform init
    * terraform plan
    * terraform apply
* Functions
    * npm run build

## TODO
* Manage IAM roles via terraform
* Write unit test for functions and magento custom modules
* create EC2 instance via terraform
* create an apigateway for magento. so magento can communicate with the lambda functions to publish the messages via REST.
* remove aws credentials from git
* add env variables in the deployment process
* create an admin grid to manage partner