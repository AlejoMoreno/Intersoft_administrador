var DB = new DataBase();
function DataBase(){

    //create database
    this.init = function(){
        db = openDatabase("Intersoft", "0.1", "Intersoft", 200000);
        if (db) {
            // Database opened
            db.transaction( function(tx) {
                tx.executeSql("CREATE TABLE IF NOT EXISTS Session("+
                    "userid integer primary key autoincrement,"+
                    "ncedula text,"+ 
                    "password text,"+ 
                    "Id_empresa,"+
                    "Razon_social,"+
                    "Nit_empresa,"+
                    "Telefono,"+
                    "Id_ciudad)")
            });
        }
    };

    this.insertSession = function(){
        db.transaction( function(tx) {
            tx.executeSql("INSERT INTO Session(ncedula, password, Id_empresa, Razon_social, Nit_empresa, Telefono, Id_ciudad) VALUES(?,?,?,?,?,?,?)", 
                [localStorage.getItem("ncedula"), 
                localStorage.getItem("Password"),
                localStorage.getItem("Id_empresa"),
                localStorage.getItem("Razon_social"),
                localStorage.getItem("Nit_empresa"),
                localStorage.getItem("Telefono"),
                localStorage.getItem("Id_ciudad")]);
        });
        this.listSession();
    };    

    this.listSession = function(){
        db.transaction( function(tx) {
            tx.executeSql("SELECT * FROM Session", [],
                function(tx, result){
                    var output = [];
                    for(var i=0; i < result.rows.length; i++) {
                        output.push([result.rows.item(i)['userid'],
                                result.rows.item(i)['ncedula'],
                                result.rows.item(i)['password'],
                                result.rows.item(i)['Id_empresa'] ]);
                    }
                    console.log(output);    
                });
        });
    };

    this.removeSession = function(userId){
        db.transaction(function(tx) {
            tx.executeSql("DELETE FROM Session WHERE userId=?",[userId], this.listSession());
        })
    };

    this.printSession = function(Session){
        var place = document.getElementById("usersDiv");
        if (place.getElementsByTagName("ul").length > 0 )
            place.removeChild(place.getElementsByTagName("ul")[0]);
        var list = document.createElement("ul");
    
        for ( var i = 0; i < Session.length; i++) {
            var item = document.createElement("li");
            item.innerHTML += "<b>userId:</b>" + Session[i][0] + " <b>userName:</b>"
                    + Session[i][1] + " <b>password:</b>" + Session[i][2] +
                    "<button onclick='removeUser("+ Session[i][0]+")'>Remove</button>";
            list.appendChild(item);
        }
        place.appendChild(list);
    };

}