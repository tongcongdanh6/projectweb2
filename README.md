- [CHANGE LOG](#change-log)
  - [15/05/2021 20:00](#15052021-2000)
    - [Value Code Of [Task Status]](#value-code-of-task-status)
  - [17/05/2021 21:36](#17052021-2136)
    - [Module TASK](#module-task)
      - [Quyền USER](#quyền-user)
  - [8:32 PM 5/18/2021](#832-pm-5182021)
    - [Module LOGIN](#module-login)
    - [Layout](#layout)
    - [Module TASK DETAIL](#module-task-detail)
    - [Module TASK](#module-task-1)

# CHANGE LOG
## 15/05/2021 20:00
### Value Code Of [Task Status]
`1 - Vừa nhận`<br>
`2 - Đang thực hiện`<br>
`3 - Trì hoãn`<br>
`4 - Hoàn tất`<br>

## 17/05/2021 21:36
### Module TASK
#### Quyền USER
1) Cập nhật TASK (trạng thái)

## 8:32 PM 5/18/2021
### Module LOGIN
1 - Thêm thuộc tính <b>fullname</b> trong Session

### Layout
- Thay đổi hiển thị trên header bằng fullname thay vì email
- Thêm badge hiển thị quyền hạn trên header (frontend - FE)
- Sửa danh sách menu (navigation.php) dựa vào quyền
  - Nhân viên: `KHÔNG` có quyền `thêm` `task` và `nhân viên` mới nên ẨN các menu này đi

### Module TASK DETAIL
- Hiển thị nút XÓA CÔNG VIỆC theo quyền (chỉ có admin và trưởng phòng mới có nút này)
- Thêm "người được giao" trong task detail (FE)


### Module TASK
- Thêm chức năng: `SỬA`
  - `Admin`: Được chỉnh sửa Tất cả Field + Tất cả phòng ban
  - `Trưởng phòng`: Chỉnh sửa Tất cả Field + Chỉ phòng ban do người đó quản lý
  - `Nhân viên`: Chỉ được chỉnh sửa Trạng thái công việc
    - Chỉ có 2 trạng thái công việc được chỉnh sửa là `Đang thực hiện + Đã hoàn thành`

- Thêm chức năng: `XÓA`
  - `Admin`: Xóa được hết tất cả task các phòng ban
  - `Trưởng phòng`: Xóa được task của phòng ban đó
  - `Nhân viên`: Không được xóa
