create database cinemas;
use cinemas;

create table Users(
		id_User int auto_increment,
        userEmail varchar(30) unique,
        userPass varchar(30),
        userType varchar(20),
        primary key (id_User)
);


drop table Users;
delete from Users;
select * from users;
SELECT * FROM Users WHERE userEmail="pablo" AND userPass="1234";
insert into users(userEmail,userPass,userType) values('pablomdq.r.s@gmail.com','1234','user');
insert into users(userEmail,userPass,userType) values('admin@gmail.com','1234','admin');
SELECT * FROM Users WHERE userEmail=pablo AND userPass=1234;


create table cinemas(
		id_Cinema int auto_increment unique,
        cinemaName varchar(30) unique,
        cinemaAddress varchar (30),
        totalSits int,
        ticketPrice int,
        moviesOnPlay int DEFAULT 0,
        primary key (id_Cinema)
);
SELECT * FROM Movies_X_Cinemas join Cinemas 
            on Movies_X_Cinemas.id_Cinema = Cinemas.id_Cinema having
            Movies_X_Cinemas.movieDate >= '2019/10/11'
            and  Movies_X_Cinemas.movieDate <= '2020/01/01';
           
            
insert into Cinemas(cinemaName,cinemaAddress,totalSits,ticketPrice) values("American Cinema","Road 3 445",100,150),("Western Cinema","OldWest 223",120,100),("LatinCinema","newWay 332",80,50);
select * from cinemas;

SELECT * FROM Cinemas WHERE id_Cinema=1;
create table Movies(
		id_Movie int auto_increment,
        title varchar(100),
        votes int,
        popularity int,
        releaseDate date,
        overview varchar(200),
        poster_path varchar(100),
        genreID int,
        primary key (id_Movie)
);
select * from movies;

/* Here the table how represent de function , the day when the movie it will be played*/
create table Movies_X_Cinemas( /* Dias y horarios*/
		id_MXC int auto_increment unique,
        id_Cinema int,
        id_Movie int,
        movieRoom int,
        movieDate date,
        movieTime time,
        sitsLeft int,
        primary key (id_MXC),
        foreign key (id_Cinema) references Cinemas (id_Cinema),
        foreign key (id_Movie) references Movies (id_Movie)
        
);

select * from Movies_X_Cinemas;
select * from Movies_X_Cinemas where movieDate="2019-12-12" AND movieRoom="2" AND movieTime>="20:00:00";
delete from Movies_X_Cinemas where id_MXC=1;
select * from Movies_X_Cinemas order by id_Movie;
select * from Movies_X_Cinemas where id_Cinema=1 and id_Movie=21;
update Movies_X_Cinemas set sitsLeft = sitsLeft-2 where Movies_X_Cinemas.id_MXC=1;
create table Reservations(
		id_Reservation int auto_increment,
        id_MXC int, /* a function X CINE EN X MOMENTO*/
        reservedSits int,
        id_User int,
		state varchar(30),
		creditCard varchar(20),
		totalAmount int,
        ticketPrice int,
        cinemaName varchar(20),
        movieTitle varchar (20),
        reservationDate varchar(20),
        movieDate date,
        movieTime time,
        movieRoom int,
        primary key (id_Reservation),
		foreign key (id_MXC) references Movies_X_Cinemas (id_MXC),       
        foreign key (id_User) references Users (id_User)
);

SELECT * FROM reservations join Movies_X_Cinemas on reservations.id_MXC=Movies_X_Cinemas.id_MXC and Movies_X_Cinemas.id_Cinema=1;
select * from reservations where movieTitle="Joker" ;
SELECT * FROM reservations join Movies_X_Cinemas on reservations.id_MXC=Movies_X_Cinemas.id_MXC and Movies_X_Cinemas.id_Cinema=1;
SELECT * FROM reservations;
insert into Reservations(id_MXC,reservedSits,id_User,reservationDate) values (1,3,1,'2020-12-03'),(2,2,2,'2020-03-03');
select Reservations.id_Reservation,Movies_X_Cinemas.movieDate,Movies_X_Cinemas.movieTime,Cinemas.cinemaName,Cinemas.cinemaAddress,Movies.title from reservations inner join Movies_X_Cinemas,Cinemas,Movies ;
select * from reservations;
delete from reservations;

create table Tickets(
		id_Ticket int auto_increment,
        id_Reservation int,
         totalAmount int,
        QR int,
		primary key (id_Ticket),
        foreign key (id_Reservation) references Reservations (id_Reservation)
);

select * from cinemas;
update cinemas set moviesOnPlay=2 where id_cinema=100;
insert into Movies(title,votes,popularity,releaseDate,overview,moviePicture) 
				values		('Joker','8.7',500.32,'2019-10-04','Some Overview','https://image.tmdb.org/t/p/w500/udDclJoHjfjb8Ekgsd4FDteOkCU.jpg'),
							('El Camino: A Breaking Bad Movie','7.3',255.3,'2019-10-11','Some Overview','https://image.tmdb.org/t/p/w500/ePXuKdXZuJx8hHMNr2yM4jY2L7Z.jpg'),
							('Gemini Man','5.9','166.123','2019-10-11','Some everview','https://image.tmdb.org/t/p/w500/uTALxjQU8e1lhmNjP9nnJ3t2pRU.jpg'),
							('It Chapter Two','7','122.817','2019-09-06','Somee overview','https://image.tmdb.org/t/p/w500/zfE0R94v1E8cuKAerbskfD3VfUt.jpg'),
                            ('Toy Story 4','7.6','137.446',' 2019-06-21','Overview','https://image.tmdb.org/t/p/w500/w9kR8qbmQ01HwnvK4alvnQ2ca0L.jpg');

select * from movies;
select Cinemas.cinemaName,Movies.title,Movies_X_Cinemas.movieDate,Movies_X_Cinemas.movieTime from Cinemas inner join Movies,Movies_X_Cinemas where Cinemas.id_Cinema = 1 AND Movies_X_Cinemas.movieDate = '01/12/19';

insert into Movies_X_Cinemas(id_Cinema,id_Movie,movieDate,movieTime) values (102,3,'01/12/19','13:00:00');
SELECT * from Movies_X_Cinemas;
SELECT * FROM Movies_X_Cinemas JOIN MOVIES ON Movies_X_Cinemas.id_Movie=Movies.id_Movie and Movies_X_Cinemas.id_Cinema=1 ;

SELECT * FROM reservations join Cinemas on reservationDate>'12/12/2018' and reservationDate<'12/12/2020';


SELECT * from Movies_X_Cinemas where id_Cinema=100; 


SELECT * FROM Movies_X_Cinemas join Movies on movieDate >= '2019-10-28'  and  movieDate<='2020-12-12' and Movies_X_Cinemas.id_Movie = Movies.id_Movie;


delete from Movies_X_Cinemas;
/*01/01/98 23:59:59.999 datetime example*/
insert into Movies_X_Cinemas(id_Cinema,id_Movie,movieDate,movieTime) values (1,1,'01/12/19','13:00:00'),(1,2,'02/12/19','18:00:00'),(1,3,'03/12/19','22:00:00'),
																			(2,1,'01/12/19',' 13:00:00'),(1,2,'02/12/19',' 18:00:00'),(1,3,'03/12/19 ','22:00:00'),
																			(3,1,'01/12/19',' 13:00:00'),(1,2,'02/12/19',' 18:00:00'),(1,3,'03/12/19',' 22:00:00');
                                                                

insert into Movies_X_Cinemas(id_Cinema,id_Movie,movieDate,movieTime) values (3,1,'01/12/19 ','13:00:00'),(2,2,'02/12/19 ','18:00:00'),(1,3,'03/12/19 ','22:00:00'),
																(2,1,'01/12/19 ','13:00:00'),(1,2,'02/12/19 ','18:00:00'),(3,3,'03/12/19 ','22:00:00'),
                                                                (1,1,'01/12/19',' 13:00:00'),(3,2,'02/12/19 ','18:00:00'),(2,3,'03/12/19 ','22:00:00');
                                                                
select Cinemas.cinemaName,Movies.title,Movies_X_Cinemas.movieDate,Movies_X_Cinemas.movieTime from Movies_X_Cinemas join (Movies,Cinemas) on Movies.id_Movie=Cinemas.id_Cinema; /*on Cinemas.id_Cinema=Movies_X_Cinemas.id_Movie;*/
