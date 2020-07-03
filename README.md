## Project description

## List of tasks before start the project
* Setup magento 1.9 with mysql
    * estimation - 3 hrs
* Refresh 4 years old magento 1.9 memories.
    * estimation - 4 hrs
* Understand the project requirements.
    * estimation - 1 hrs
* Design the project and picture it
    * estimation - 3 hrs
* List all the task and estimate time with considering estimations can go wrong.
    * estimation - 1hrs

## System diagram
![GitHub Logo](/doc/Partner%20Invoice-Page-1.png)

## Pseudo code
#### Identify partner invoice item function
```
foreach(order.items as i => item) {
    if(i%2) {
        mark the item for main warehouse
    } else {
        mark the item for partner
    }
}
```

#### POST endpoint
```
generateInvoice(items);
generateShipment(items);
ack();
```

## Decisions
`TODO`

## Assumptions
`TODO`

## List of tasks
`TODO`

## How to run this project in your localhost
`TODO`

## Good reads
`TODO`
