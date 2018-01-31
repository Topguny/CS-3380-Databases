/*Group 2
Written by Brian Riddle 3/11/17*/

DROP TABLES IF EXISTS Authentication, Log, Car_Dates_Avail, Order_Car_Assignments,CustomerOrder,Car, Train, Administrator, Conductor, Engineer, Employee; /* These tables are in the correct order. DO NOT CHANGE! */

CREATE TABLE Employee(
    employeeID int NOT NULL,
    firstName varchar(255) NOT NULL,
    lastName varchar(255) NOT NULL,
PRIMARY KEY(employeeID)
);

CREATE TABLE Administrator(
  employeeID int NOT NULL,
PRIMARY KEY(employeeID),
FOREIGN KEY(employeeID) REFERENCES Employee(employeeID)
);

CREATE TABLE Conductor(
  employeeID int NOT NULL,
 `status` char(1) NOT NULL, /* A = Active and I= Inactive */
 rank varchar(30),
PRIMARY KEY(employeeID),
FOREIGN KEY(employeeID) REFERENCES Employee(employeeID)
);

CREATE TABLE Engineer(
  employeeID int NOT NULL,
 `status` char(1) NOT NULL, /* A = Active and I= Inactive */
  totalHoursTraveled int,
  rank varchar(30),
PRIMARY KEY(employeeID),
FOREIGN KEY(employeeID) REFERENCES Employee(employeeID)
);
/* Train needs field days they are run. Value like (Mon/Wed/Thu/Sat) in the document
Also needs departureTime and destinationTime as customers are shown these.
We need to store the conductors and engineers assigned to the train somewhere like new table TrainPersonnel
or add fields to Train like conductorid, engineerid1, enginerid2 */

CREATE TABLE Train(
  trainNum int NOT NULL,
  numOfCars int,
  departure varchar(255),
  destination varchar(255),
    departureTime TIME,
    destinationTime Time,
    conductorID int NOT NULL,
    engineerID1 int NOT NULL,
    engineerID2 int NOT NULL,
PRIMARY KEY(trainNum),
    FOREIGN KEY (conductorId) REFERENCES Conductor(employeeID),
    FOREIGN KEY (engineerID1) REFERENCES Engineer(employeeID),
    FOREIGN KEY (engineerID2) REFERENCES Engineer(employeeID)
);
/* Car will need a field price so the total price in CustomerOrder can be calculated and customer can search by price range
need index on type, location and price
also need status of car to determine if it is available for the customer order,
need to know the dates car is available and the status for that date
assuming car is always assigned to a train
do we need another table for car dates available? */

CREATE TABLE Car(
  carNum int NOT NULL,
  trainNum int NOT NULL,
  capacity int,
  `type` varchar(30) NOT NULL,
  manufacturer varchar(255),
  location varchar(50) NOT NULL,
  pullWeight int,
    price int,
PRIMARY KEY(carNum),
FOREIGN KEY(trainNum) REFERENCES Train(trainNum)
    
);

Create TABLE Car_Dates_Avail(
    carNum int NOT NULL,
    availDate Date NOT NULL,
    availStatus char(1) NOT NULL DEFAULT "A", 
    PRIMARY KEY (carNum, availDate),
    FOREIGN KEY (carNum) REFERENCES Car(carNum)
);

/* can the customer order more than one type of car? We're assuming they can only order one type
need carNums for the order -- do we need another table between car and customer order to link the customer order to cars 
also need the date and cargo type for the customerOrder as fields 
also with companyId as primary key we're assuming the customer can only make one order, adding sequence number*/
CREATE TABLE CustomerOrder(
    customerOrderID int NOT NULL AUTO_INCREMENT,
  companyID int NOT NULL,
  typeOfCar varchar(30) NOT NULL,
  numOfCars int,
  location varchar(255) NOT NULL,
  totalPrice float,
  customerRequiredDate Date NOT NULL,
  cargoType varchar(30),     
PRIMARY KEY(customerOrderID)
);

CREATE TABLE Order_Car_Assignments(
    carNum int NOT NULL,
    customerOrderID int NOT NULL,
    assignmentDate Date NOT NULL,
    PRIMARY KEY (carNum,customerOrderID),
    FOREIGN KEY (carNum) REFERENCES Car(carNum),
    FOREIGN KEY (customerOrderID) REFERENCES CustomerOrder(customerOrderID)
    );

CREATE TABLE Authentication(
  userName varchar(30) NOT NULL UNIQUE,
  `password` varchar(20) NOT NULL,
  role varchar(25) NOT NULL,
    employee_id int NOT NULL,
PRIMARY KEY (userName),
FOREIGN KEY (employee_id) REFERENCES Employee(employeeID)
);
/* need employeeId if employee makes the change and companyid if customer makes the customer order
also need a unique sequence number as a PK */

CREATE TABLE Log(
    logID int NOT NULL AUTO_INCREMENT,
 `action` varchar(30),
 log_date Date,
 log_time Time,
 ipAddress varchar(30),
 specificAction varchar(255),
 employeeId int NULL,
    companyId int,
    PRIMARY KEY(logID),
    FOREIGN KEY(employeeId) REFERENCES Employee(employeeId)
    
    );
