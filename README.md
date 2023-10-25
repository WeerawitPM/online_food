# วิธีการติดตั้ง
#### 1. สร้างฐานข้อมูลชื่อ fooddelivery
#### 2. สร้างตารางผู้ดูแลระบบชื่อ admin
ข้อมูลในตาราง admin ประกอบด้วย

| Name | Type | Length | Primary Key | Auto Increment |
| --- | --- | --- | --- | --- |
| id | int | - | Yes | Yes |
| email | varchar | 255 | No | No |
| username | varchar | 255 | No | No |
| password | varchar | 255 | No | No |
| firstname | varchar | 255 | No | No |
| lastname | varchar | 255 | No | No |
| phone | varchar | 10 | No | No |

#

#### 3. สร้างตารางลูกค้าชื่อ customer
ข้อมูลในตาราง customer ประกอบด้วย

| Name | Type | Length | Primary Key | Auto Increment |
| --- | --- | --- | --- | --- |
| id | int | - | Yes | Yes |
| email | varchar | 255 | No | No |
| username | varchar | 255 | No | No |
| password | varchar | 255 | No | No |
| firstname | varchar | 255 | No | No |
| lastname | varchar | 255 | No | No |
| phone | varchar | 10 | No | No |
| address | varchar | 255 | No | No |
| image | varchar | 255 | No | No |
| status | varchar | 255 | No | No |

#

#### 4. สร้างตารางร้านอาหารชื่อ restaurant
ข้อมูลในตาราง restaurant ประกอบด้วย

| Name | Type | Length | Primary Key | Auto Increment |
| --- | --- | --- | --- | --- |
| id | int | - | Yes | Yes |
| email | varchar | 255 | No | No |
| username | varchar | 255 | No | No |
| password | varchar | 255 | No | No |
| firstname | varchar | 255 | No | No |
| lastname | varchar | 255 | No | No |
| phone | varchar | 10 | No | No |
| address | varchar | 255 | No | No |
| image | varchar | 255 | No | No |
| restaurant_name | varchar | 255 | No | No |
| restaurant_type | varchar | 255 | No | No |
| status | varchar | 255 | No | No |

#

#### 5. สร้างตารางประเภทร้านอาหารชื่อ restaurant_type
ข้อมูลในตาราง restaurant_type ประกอบด้วย

| Name | Type | Length | Primary Key | Auto Increment |
| --- | --- | --- | --- | --- |
| id | int | - | Yes | Yes |
| name | varchar | 255 | No | No |

#

#### 6. สร้างตารางหมวดหมู่อาหารชื่อ food_category
ข้อมูลในตาราง food_category ประกอบด้วย

| Name | Type | Length | Primary Key | Auto Increment |
| --- | --- | --- | --- | --- |
| id | int | - | Yes | Yes |
| name | varchar | 255 | No | No |
| restaurant_id | int | 11 | No | No |

#

#### 7. สร้างตารางเมนูอาหารชื่อ food
ข้อมูลในตาราง food ประกอบด้วย

| Name | Type | Length | Primary Key | Auto Increment |
| --- | --- | --- | --- | --- |
| id | int | - | Yes | Yes |
| name | varchar | 255 | No | No |
| price | int | 11 | No | No |
| detail | varchar | 255 | No | No |
| image | varchar | 255 | No | No |
| food_category | varchar | 255 | No | No |
| restaurant_id | int | 11 | No | No |

#

#### 8. สร้างตารางคนส่งอาหารชื่อ rider
ข้อมูลในตาราง rider ประกอบด้วย

| Name | Type | Length | Primary Key | Auto Increment |
| --- | --- | --- | --- | --- |
| id | int | - | Yes | Yes |
| email | varchar | 255 | No | No |
| username | varchar | 255 | No | No |
| password | varchar | 255 | No | No |
| firstname | varchar | 255 | No | No |
| lastname | varchar | 255 | No | No |
| phone | varchar | 10 | No | No |
| address | varchar | 255 | No | No |
| car_no | varchar | 255 | No | No |
| image | varchar | 255 | No | No |
| status | varchar | 255 | No | No |

#