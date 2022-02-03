create table addons
(
    id   serial
        constraint addons_pk
            primary key,
    name varchar(255) not null
);

alter table addons
    owner to wkknmohztmvnqy;

create unique index addons_id_uindex
    on addons (id);

INSERT INTO public.addons (id, name) VALUES (13, 'liść truskawki');
INSERT INTO public.addons (id, name) VALUES (14, 'jagody goji');
INSERT INTO public.addons (id, name) VALUES (15, 'skórka pomarańczy');
INSERT INTO public.addons (id, name) VALUES (16, 'morwa');
INSERT INTO public.addons (id, name) VALUES (17, 'żurawina');
INSERT INTO public.addons (id, name) VALUES (18, 'porzeczka');
INSERT INTO public.addons (id, name) VALUES (19, 'malina');
INSERT INTO public.addons (id, name) VALUES (20, 'guarana');
INSERT INTO public.addons (id, name) VALUES (21, 'mięta polej');
INSERT INTO public.addons (id, name) VALUES (22, 'cedron ');
INSERT INTO public.addons (id, name) VALUES (23, 'naturalny ekstrakt z guarany');


create table origin
(
    id      serial
        constraint origin_pk
            primary key,
    country varchar(255) not null,
    flag    varchar(255) not null
);

alter table origin
    owner to wkknmohztmvnqy;

create unique index origin_id_uindex
    on origin (id);

INSERT INTO public.origin (id, country, flag) VALUES (1, 'Argentyna', 'argentina.jpg');
INSERT INTO public.origin (id, country, flag) VALUES (2, 'Brazylia', 'brazil.jpg');
INSERT INTO public.origin (id, country, flag) VALUES (3, 'Paragwaj', 'paraguay.png');
INSERT INTO public.origin (id, country, flag) VALUES (4, 'Urugwaj', 'uruguay.png');

create table type
(
    id   serial
        constraint type_pk
            primary key,
    name varchar(255) not null
);

alter table type
    owner to wkknmohztmvnqy;

create unique index type_id_uindex
    on type (id);

INSERT INTO public.type (id, name) VALUES (1, 'despalada');
INSERT INTO public.type (id, name) VALUES (2, 'elaborada');
INSERT INTO public.type (id, name) VALUES (3, 'suave');
INSERT INTO public.type (id, name) VALUES (4, 'sin humo');
INSERT INTO public.type (id, name) VALUES (5, 'barbacua');
INSERT INTO public.type (id, name) VALUES (6, 'saborizada');
INSERT INTO public.type (id, name) VALUES (7, 'con hierbas');

create table role
(
    id   serial
        constraint role_pk
            primary key,
    role varchar(255) not null
);

alter table role
    owner to wkknmohztmvnqy;

create unique index role_id_uindex
    on role (id);

INSERT INTO public.role (id, role) VALUES (1, 'normal');
INSERT INTO public.role (id, role) VALUES (2, 'mod');
INSERT INTO public.role (id, role) VALUES (3, 'admin');

create table users
(
    id       integer default nextval('user_id_seq'::regclass) not null
        constraint user_pk
            primary key,
    id_role  integer                                          not null
        constraint user_role_id_fk
            references role,
    name     varchar(255)                                     not null,
    email    varchar(255)                                     not null,
    password varchar(255)                                     not null,
    avatar   varchar(255)                                     not null
);

alter table users
    owner to wkknmohztmvnqy;

create unique index user_id_uindex
    on users (id);

INSERT INTO public.users (id, id_role, name, email, password, avatar) VALUES (7, 3, 'admin', 'admin@admin.admin', '$argon2id$v=19$m=65536,t=4,p=1$TXN3RUlPZzRPMER4MWRoUg$y8RvEtcxdkcDYFVR33opOEGouFKMLkXu6mUwhxJUf+M', 'default.jpg');
INSERT INTO public.users (id, id_role, name, email, password, avatar) VALUES (8, 1, 'user1', 'user1@email.com', '$argon2id$v=19$m=65536,t=4,p=1$aTJTdi9ISnpsYXFQVEFIVw$Z1iI30SKhESPYwyXTCdOqq0O0W/SLlPcmu1txguNSi4', 'obraz_2022-02-03_120428.png');
INSERT INTO public.users (id, id_role, name, email, password, avatar) VALUES (9, 1, 'user2', 'user2@email.com', '$argon2id$v=19$m=65536,t=4,p=1$QnpBQ2MuWEI0OUY2RlNVdg$LZDT5V90sTVptKS/5BAYo1h5+YDhRiAe9LeI2mUvTGM', 'default.jpg');
INSERT INTO public.users (id, id_role, name, email, password, avatar) VALUES (10, 1, 'user3', 'user3@email.com', '$argon2id$v=19$m=65536,t=4,p=1$MmV5Ni9lTUNRQ3REbDlWYQ$wZKvwrHaYOFTEml6Vhpx280Sz1Ex/ZixJfM/E0eAR7A', 'default.jpg');

create table average_rating
(
    id             serial
        constraint average_rating_pk
            primary key,
    id_yerba       integer                    not null
        constraint average_rating_yerba_id_fk
            references yerba,
    general        double precision default 0 not null,
    dust           double precision default 0 not null,
    green          double precision default 0 not null,
    intensity      double precision default 0 not null,
    strength       double precision default 0 not null,
    addons         double precision default 0 not null,
    smoke          double precision default 0 not null,
    num_of_ratings double precision default 0 not null
);

alter table average_rating
    owner to wkknmohztmvnqy;

create unique index average_rating_id_uindex
    on average_rating (id);

INSERT INTO public.average_rating (id, id_yerba, general, dust, green, intensity, strength, addons, smoke, num_of_ratings) VALUES (15, 24, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO public.average_rating (id, id_yerba, general, dust, green, intensity, strength, addons, smoke, num_of_ratings) VALUES (18, 27, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO public.average_rating (id, id_yerba, general, dust, green, intensity, strength, addons, smoke, num_of_ratings) VALUES (19, 28, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO public.average_rating (id, id_yerba, general, dust, green, intensity, strength, addons, smoke, num_of_ratings) VALUES (20, 29, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO public.average_rating (id, id_yerba, general, dust, green, intensity, strength, addons, smoke, num_of_ratings) VALUES (21, 30, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO public.average_rating (id, id_yerba, general, dust, green, intensity, strength, addons, smoke, num_of_ratings) VALUES (13, 22, 4, 5, 1, 5, 5, 1, 5, 1);
INSERT INTO public.average_rating (id, id_yerba, general, dust, green, intensity, strength, addons, smoke, num_of_ratings) VALUES (14, 23, 3, 2, 2, 1, 2, 3, 2, 1);
INSERT INTO public.average_rating (id, id_yerba, general, dust, green, intensity, strength, addons, smoke, num_of_ratings) VALUES (12, 21, 1, 3, 5, 1, 2, 3, 2, 1);
INSERT INTO public.average_rating (id, id_yerba, general, dust, green, intensity, strength, addons, smoke, num_of_ratings) VALUES (16, 25, 4, 5, 1, 5, 5, 1, 5, 1);
INSERT INTO public.average_rating (id, id_yerba, general, dust, green, intensity, strength, addons, smoke, num_of_ratings) VALUES (22, 31, 4, 1, 2, 2, 2, 1, 2, 1);
INSERT INTO public.average_rating (id, id_yerba, general, dust, green, intensity, strength, addons, smoke, num_of_ratings) VALUES (17, 26, 10, 5, 8, 6, 7, 2, 3, 2);
INSERT INTO public.average_rating (id, id_yerba, general, dust, green, intensity, strength, addons, smoke, num_of_ratings) VALUES (23, 32, 14, 8, 9, 12, 13, 3, 8, 3);

create table yerba
(
    id          serial
        constraint yerba_pk
            primary key,
    id_origin   integer      not null
        constraint yerba_origin_id_fk
            references origin,
    id_type     integer      not null
        constraint yerba_type_id_fk
            references type,
    name        varchar(255) not null,
    description text         not null,
    image       varchar(255) not null
);

alter table yerba
    owner to wkknmohztmvnqy;

create unique index yerba_id_uindex
    on yerba (id);

INSERT INTO public.yerba (id, id_origin, id_type, name, description, image) VALUES (21, 2, 6, 'Mate Green FRUTAS', 'Niezwykła kompozycja yerba mate  najbogatszego rozbudowanego bukietu owocowego, jaki mamy w Mate Green.
Delikatny smak mate green doskonale koresponduje z bogatą mieszanką owocową, w skład której wchodzą liść truskawki, jagody goji, skórka pomarańczy, suszona żurawina, owoce morwy, porzeczki i maliny.
Owoc Goji znają już chyba wszyscy, którzy znają super foods. Chińczycy od wieków wykorzystywali je w swojej medycynie, ludowej i kuchni od tysięcy lat. Komponują się swym słodkim smakiem idealnie z  ilex paraguariensis i cieszą oczy swym czerwonym kolorem.
Jagody żurawiny - znane i lubiane jako przekąska - znalazły się w naszym MG Frutas za sprawą swych drogocennych właściwości tak szeroko opisywanych. Słodkie owoce malin komponują się idealnie z brazylijskim suszem nadając mu soczystego słodkiego posmaku i zapachu późnego lata. Nie mogło ich zabraknąć w naszej owocowej mate. Słodkie owoce morwy, używane od setek lat w medycynie ludowej i naturalnej  wracają ostatnio do łask w dietetyce i kuchni. Ich delikatna słodycz jest nieodzownym składnikiem MG Frutas, którą szczególnie preferują osoby mające wyrafinowany gust i nielubiące zbyt gorzkich i cierpkich yerba mate.
Pachnące późną wiosną liście truskawki współgrają z suszem yerba mate tworząc w całej kompozycji ciekawą przeciwwagę dla nut słodkich i gorzkawych. Skórka pomarańczowa, nadaje tej smacznej yerba mate cytrusowy aromat tropikalnego powabu i wnosi nutę rozgrzanych latem tropikalnych plaż.', 'obraz_2022-02-02_195001.png');
INSERT INTO public.yerba (id, id_origin, id_type, name, description, image) VALUES (22, 3, 2, 'PAJARITO ELABORADA', 'Yerba mate Pajarito Elaborada to klasyka z Paragwaju. Pajarito oznacza po hiszpańsku „ptaszek” i na nazwie kończy się delikatności. Mocna w działaniu i wyraźna w smaku. Tu nie ma miejsca na subtelności - to jest mate w stylu macho. Wielu mateistów mówiąc yerba, myśli właśnie Elaborada od Pajarito. Być może dlatego, że kto jej spróbował, ten długo pamięta wyjątkowo przyjemny smak. Jedna z tych odmian, które dostarczają energii na długo. Tajemnicą firmy jest sposób uprawy ostrokrzewu. Wiemy o nim tyle, że zbiera się tylko najlepsze listki i gałązki. W późniejszym etapie specjalne receptury przygotowania i palenia czynią z niej jedną z najlepszych mate na świecie. Pozostawia wyrazisty smak i przyjemne wspomnienia.', 'obraz_2022-02-02_195339.png');
INSERT INTO public.yerba (id, id_origin, id_type, name, description, image) VALUES (23, 2, 6, 'Verde Mate Green Energia Guarana', 'Verde Mate Green to bestsellerowa yerba mate z kameralnej plantacji w brazylijskiej Paranie. Cechuje się dużą zawartością naturalnej kofeiny i łagodnym roślinnym smakiem. Wszystko dzięki unikatowej technice suszenia listków ostrokrzewu przy użyciu gorącego powietrza. Jej delikatny charakter sprawia, że Verde Mate Green doskonale łączy się z naturalnymi dodatkami ziół i owoców.

Verde Mate Energia Guarana to legendarne połączenie yerba mate i guarany. Owoce tej południowoamerykańskiej rośliny słyną z bardzo dużej zawartości naturalnej kofeiny. Ich łagodny i świeży smak idealnie współgra ze szlachetną goryczką yerba mate. W składzie znajdziemy też uznawane za "superfood" jagody goji oraz płatki kwiatu nagietka. Całość uzupełnia całkowicie naturalny aromat, który - w przeciwieństwie do potencjalnie groźnych dla zdrowia sztucznych odpowiedników - powstaje wyłącznie z substancji naturalnego pochodzenia.', 'obraz_2022-02-02_195458.png');
INSERT INTO public.yerba (id, id_origin, id_type, name, description, image) VALUES (24, 1, 6, 'CBSe Energia Guarana', 'CBSe Energia Guarana to jedna z najpopularniejszych mocno pobudzających yerba mate. Tradycyjny argentyński susz spotyka się tu z dodatkiem ziół i guarany. Owoc słynie z dużej zawartości naturalnej kofeiny. W połączeniu z ostrokrzewem otrzymujemy niezwykle silnie pobudzającą mieszankę', 'obraz_2022-02-02_195614.png');
INSERT INTO public.yerba (id, id_origin, id_type, name, description, image) VALUES (25, 1, 2, 'TARAGUI + ENERGIA', 'Taragui Energia składa się w stu procentach z listków, patyczków i łodyżek ostrokrzewu paragwajskiego - nie zawiera dodatków owocowych ani ziołowych.

Yerba mate pod marką Taragui jest uprawiana w Las Marias z wykorzystaniem jedynie ekologicznych metod od ponad dziewięćdziesięciu lat, w czasie których przeszła do klasyki oraz zdobyła uznanie smakoszy na całym świecie, potwierdzone m. in. nadaniem certyfikatu “Alimentos Argentinos, una elección natural” ("Argentyńska żywność, naturalny wybór").

Warto zaznaczyć, że Taragui Energia jest zbierana w pełni lata oraz suszona bez użycia dymu, dzięki czemu smak jest pełny i głęboki, a niezapomniany aromat nie zawiera nienaturalnych nut spalenizny. Napar posiada bardzo silne działanie pobudzające, wpływa korzystnie na koncentrację oraz pozwala zwalczyć senność i zmęczenie, a w lecie cudownie odświeża i orzeźwia umysł oraz ciało. Yerba Mate Taragui Energia to dobry wybór dla miłośników tradycyjnego, intensywnego smaku i mocy yerba mate.', 'obraz_2022-02-02_195734.png');
INSERT INTO public.yerba (id, id_origin, id_type, name, description, image) VALUES (26, 1, 4, 'La Merced Campo Sur', 'La Merced Campo Sur to ekskluzywna propozycja dla koneserów yerba mate najwyższej klasy. Jej producentem jest przedsiębiorstwo Las Marias odpowiedzialne m.in. za Taragui. La Merced to marka znana z yerb pozbawionych jakichkolwiek dodatków smakowych. Wariacje różnią się pochodzeniem i – co za tym idzie – charakterem suszu. W przypadku La Merced Campo Sur mamy do czynienia z yerba mate rodem z południa Argentyny. Produkt składa się ze średnio ciętych listków ostrokrzewu w obecności przeciętnej ilości patyczków i pyłu. Wyróżnia go szeroko pojęta delikatność przy jednoczesnej dużej zawartości kofeiny.', 'obraz_2022-02-02_200004.png');
INSERT INTO public.yerba (id, id_origin, id_type, name, description, image) VALUES (27, 3, 2, 'Kurupi Tradicional', 'Kurupi Tradicional to klasyczna paragwajska yerba mate składająca się wyłącznie w 100% z listków i patyczków ostrokrzewu paragwajskiego.

Ta popularna mate nie zawiera  żadnych dodatków. Należy do  grupy yerba mate o soczystym naturalnym aromacie. Posiada standardową ilość kofeiny.

Od swojej siostry, czyli Kurupi "Clásica" różni się sposobem produkcji. Kurupi Tradicional jest leżakowana krócej, przez co cechuje się  wyraźniejszym smakiem oraz odrobinę więcej patyczków. W efekcie mamy tu esencjonalnie paragwajską yerba mate.', 'obraz_2022-02-02_200105.png');
INSERT INTO public.yerba (id, id_origin, id_type, name, description, image) VALUES (28, 3, 2, 'Kurupi Clasica', 'Kurupi Clasica Yerba Mate - paragwajska yerba mate przechodząca specjalny proces obróbki w którym uzyskuje swój unikalny i niepowtarzalny smak.

Polecana dla doświadczonych mateistów ceniących mocne i wyraziste gatunki.', 'obraz_2022-02-02_200150.png');
INSERT INTO public.yerba (id, id_origin, id_type, name, description, image) VALUES (29, 1, 2, 'Rosamonte Elaborada', 'Rosamonte to jedna z najpopularniejszych, a zarazem najstarszych marek yerba mate na świecie. Cechuje się esencjonalnym aromatem w typowo argentyńskim stylu. Zawiera dużo naturalnej kofeiny', 'obraz_2022-02-02_200313.png');
INSERT INTO public.yerba (id, id_origin, id_type, name, description, image) VALUES (30, 1, 1, 'Rosamonte Despalada', 'Yerba mate Rosamonte Despalada to większe kawałki liści pozbawione patyczków i pyłu ostrokrzewu paragwajskiego. Zawartość produktu została poddana specjalnej metodzie długotrwałego leżakowania, dzięki czemu zyskała wyjątkowy aromat. Każdego typu bombilla poradzi sobie z tą yerba mate, co sprawia że jest to idealny wybór dla początkujących mateistów.', 'obraz_2022-02-02_200353.png');
INSERT INTO public.yerba (id, id_origin, id_type, name, description, image) VALUES (31, 1, 2, 'Cruz de Malta Con Palo Tradicional', 'Klasyczna argentyńska yerba mate najwyższej jakości w zupełnie nowym, premierowym opakowaniu. Uznawana za produkt dla prawdziwych koneserów. Marka z długoletnimi tradycjami i wysokim standardem, pod logiem maltańskiego krzyża dostarcza nam wysokiej klasy susz o głębokim aromacie i klasycznym smaku yerba mate. W opakowaniu znajdziemy drobno cięte listki z gałązkami oraz średnią ilość pyłu bez żadnych dodatków. Pijąc tę yerbę, kosztujesz argentyńskiej klasyki w elitarnym wydaniu. ', 'obraz_2022-02-02_200443.png');
INSERT INTO public.yerba (id, id_origin, id_type, name, description, image) VALUES (32, 1, 2, 'La Rubia Elaborada Con Palo Tradicional', 'Pochodząca z ekologicznej uprawy jest specjalnie selekcjonowana dla osiągnięcia wyrazistszego smaku, a przez to doskonałego pobudzenia. Rodzinna plantacja uczestniczy w programie odbudowy lasów tropikalnych. Sięgając zatem po tę mocną mate, pomagasz ocalić unikalne środowisko. Część surowca leżakuje niemal cały rok dla wydobycia intensywności smaku i aromatu. La Rubia dosłownie znaczy po hiszpańsku „blondynka”. Ta dama należy do grona wielbicielek wytrawnych smaków w najlepszym wydaniu.', 'obraz_2022-02-02_200523.png');

create table addons_yerba
(
    id_yerba  integer not null
        constraint addons_yerba_yerba_id_fk
            references yerba,
    id_addons integer not null
        constraint addons_yerba_addons_id_fk
            references addons
);

alter table addons_yerba
    owner to wkknmohztmvnqy;

INSERT INTO public.addons_yerba (id_yerba, id_addons) VALUES (21, 13);
INSERT INTO public.addons_yerba (id_yerba, id_addons) VALUES (21, 14);
INSERT INTO public.addons_yerba (id_yerba, id_addons) VALUES (21, 15);
INSERT INTO public.addons_yerba (id_yerba, id_addons) VALUES (21, 16);
INSERT INTO public.addons_yerba (id_yerba, id_addons) VALUES (21, 17);
INSERT INTO public.addons_yerba (id_yerba, id_addons) VALUES (21, 18);
INSERT INTO public.addons_yerba (id_yerba, id_addons) VALUES (21, 19);
INSERT INTO public.addons_yerba (id_yerba, id_addons) VALUES (23, 20);
INSERT INTO public.addons_yerba (id_yerba, id_addons) VALUES (24, 21);
INSERT INTO public.addons_yerba (id_yerba, id_addons) VALUES (24, 22);
INSERT INTO public.addons_yerba (id_yerba, id_addons) VALUES (24, 23);

create table comment
(
    id       serial
        constraint comment_pk
            primary key,
    id_user  integer not null
        constraint comment_user_id_fk
            references users,
    id_yerba integer not null
        constraint comment_yerba_id_fk
            references yerba,
    content  text    not null
);

alter table comment
    owner to wkknmohztmvnqy;

create unique index comment_id_uindex
    on comment (id);

INSERT INTO public.comment (id, id_user, id_yerba, content) VALUES (19, 8, 22, 'Phasellus eget blandit ipsum, at viverra enim. Pellentesque at rhoncus tellus. Aliquam non augue volutpat, rutrum felis eu, cursus neque. Proin lectus tortor, gravida sagittis laoreet nec, convallis eu nisl. Nullam tempus ante eget metus pretium, at pharetra est accumsan. Praesent nisi quam, tempus ac magna a, dapibus sollicitudin felis. Mauris id augue ultricies, convallis sapien ac, tincidunt dui. Duis ac arcu ante. Duis aliquet tellus a quam maximus hendrerit. Pellentesque egestas eleifend nunc quis tincidunt. Nam in pharetra ligula. Integer pretium tempus nisl eu hendrerit. Cras suscipit est ac est dapibus, ut lobortis quam egestas. Proin leo risus, ultricies id lorem et, tristique suscipit turpis. Donec ipsum turpis, ullamcorper non erat ac, efficitur aliquam metus.');
INSERT INTO public.comment (id, id_user, id_yerba, content) VALUES (20, 8, 23, 'Sed ex nisi, scelerisque ac gravida id, hendrerit et elit. Fusce ultrices orci sed purus pellentesque, imperdiet cursus libero vulputate. Etiam sit amet risus eros. Duis eu lectus quis massa pharetra lobortis non ac risus. Donec facilisis tellus eu mollis congue. Nullam ante enim, scelerisque congue ligula sit amet, molestie venenatis enim. Quisque ut ipsum vitae velit lobortis feugiat pulvinar ac tellus. Nam efficitur, eros vel semper commodo, nisi diam fringilla ligula, eget venenatis massa augue a lacus. Aliquam malesuada luctus sem, vel porttitor ex pretium in.');
INSERT INTO public.comment (id, id_user, id_yerba, content) VALUES (21, 8, 32, 'Sed pretium, ex sed consectetur bibendum, dui ante molestie nunc, semper cursus nibh justo et ex. Suspendisse lacinia tortor id lacus placerat viverra eu sit amet nulla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Curabitur sed ipsum et magna semper ornare. Curabitur et mollis metus, non egestas nunc. Praesent suscipit magna a orci tristique auctor. Pellentesque interdum neque odio, sit amet fermentum ex blandit vel. In aliquet dui at congue auctor. Praesent ac auctor lacus, quis vehicula lacus. Vestibulum maximus tristique sem commodo fermentum. Nam egestas iaculis neque quis volutpat. Aenean eu dictum magna. Nam rutrum placerat nisl, sit amet vestibulum enim pretium eu.');
INSERT INTO public.comment (id, id_user, id_yerba, content) VALUES (18, 8, 21, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque convallis non elit vitae consectetur. Nam at quam vel eros tristique commodo quis at orci. Pellentesque efficitur nibh nunc, quis feugiat lacus varius ut. Integer vel tempus lectus. Nulla eu lacus odio. Sed et lectus ultricies, tempus eros vitae, tristique ex. Donec rhoncus sodales dui, ac convallis mauris imperdiet nec. In pharetra, sem sit amet pulvinar euismod, justo tortor porta elit, sed bibendum ligula tellus eget est. Nunc consectetur, diam in porttitor placerat, diam neque vestibulum nunc, non hendrerit turpis enim et libero. Vivamus euismod risus vitae ullamcorper aliquet.');
INSERT INTO public.comment (id, id_user, id_yerba, content) VALUES (22, 8, 26, 'Aenean non felis feugiat, ornare augue eget, varius mauris. Mauris ac leo quis dui convallis vestibulum eget ut diam. Donec lacinia maximus purus at tempor. Morbi sagittis et ligula eleifend malesuada. Vestibulum non auctor ante. Cras elementum felis ac felis tempor, sed finibus magna sodales. Maecenas vel leo nunc. Cras ut mi porta, tempus ante pretium, gravida arcu.');
INSERT INTO public.comment (id, id_user, id_yerba, content) VALUES (23, 9, 32, 'Etiam imperdiet nibh vitae erat dapibus, ac porta ex sagittis. Curabitur viverra, orci eget tristique eleifend, elit neque sagittis nunc, in lobortis eros diam ac magna. Morbi mollis dui condimentum convallis dignissim. Nullam laoreet nulla vitae urna viverra, nec pharetra nunc placerat. Nullam ut pellentesque arcu, a vulputate risus. Duis tempus ipsum ut suscipit tempor. Curabitur at erat nisl.');
INSERT INTO public.comment (id, id_user, id_yerba, content) VALUES (24, 9, 25, 'Praesent sodales arcu urna, id accumsan urna bibendum at. Nullam iaculis mi et augue euismod, in imperdiet nunc suscipit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla malesuada malesuada felis. In bibendum dapibus lectus, in egestas lacus interdum et. Pellentesque eget ornare arcu. Nulla felis purus, viverra id accumsan vestibulum, molestie ut elit. Etiam in ultricies orci, sed viverra dui.');
INSERT INTO public.comment (id, id_user, id_yerba, content) VALUES (25, 9, 31, 'Vivamus non tempus felis, ac dictum ex. Nam ullamcorper sem sed neque consectetur dignissim. Duis ullamcorper dolor metus, non pellentesque massa vulputate in. Fusce egestas lectus quis arcu pharetra, vel luctus nisl ultrices. Ut ac arcu nec nibh tincidunt semper at lobortis velit. Aenean dapibus ullamcorper ultrices. Mauris iaculis convallis mauris, sit amet vehicula sapien iaculis at. Fusce at elit turpis. Fusce egestas vitae orci at tempor. Vestibulum nec tincidunt enim, vel volutpat erat. Praesent interdum lacinia ipsum, et sagittis elit aliquam eu. Sed ut turpis ac tellus interdum sodales vel sit amet nisi. Donec hendrerit, mauris nec tincidunt egestas, velit felis lobortis enim, ut tristique ex nunc eget massa.');
INSERT INTO public.comment (id, id_user, id_yerba, content) VALUES (26, 10, 26, 'Praesent aliquam velit eros, ut condimentum sem lobortis eu. Maecenas sed accumsan nisi. Quisque non fermentum sapien. Aliquam vestibulum felis vel risus lacinia pellentesque. Fusce sed consectetur magna. Curabitur id magna eleifend, ornare eros vel, blandit dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam nec ante a odio vehicula laoreet id ut ante. In malesuada, libero nec venenatis aliquet, magna erat fringilla felis, id varius nulla arcu ac ex. Curabitur in dui mollis, vulputate ligula et, tristique erat. In hendrerit urna ut mi aliquam imperdiet. Aliquam ut porttitor erat. In ullamcorper sem lorem, sed finibus libero convallis congue. Morbi augue dui, hendrerit sed dapibus id, rhoncus sit amet libero. Proin condimentum, turpis in sagittis dapibus, libero risus faucibus tellus, in scelerisque risus velit at metus.');
INSERT INTO public.comment (id, id_user, id_yerba, content) VALUES (27, 10, 32, 'Fusce ac sagittis elit. Mauris blandit metus vitae enim ultrices, eu molestie dolor euismod. Sed fringilla ornare sem ut bibendum. Fusce feugiat, risus imperdiet ullamcorper condimentum, lacus turpis facilisis purus, vitae commodo elit massa molestie ipsum. Nullam id laoreet felis. Donec rutrum diam at ex dapibus, eget lobortis elit iaculis. Quisque fermentum, odio vitae dapibus rutrum, ligula urna tempus mi, vitae viverra sem elit vitae nunc. Curabitur ut ex vitae enim venenatis bibendum. Vestibulum eleifend scelerisque consectetur. Duis efficitur libero in nunc eleifend faucibus. Morbi sit amet lacus arcu. Fusce eleifend, neque sed sagittis dapibus, lectus elit bibendum justo, non luctus lacus odio quis lorem. Donec porttitor nunc arcu, sit amet lobortis diam tristique nec. Aenean consequat consectetur pulvinar.');

create table rating
(
    id         serial
        constraint rating_pk
            primary key,
    id_comment integer          not null
        constraint rating_comment_id_fk
            references comment,
    general    double precision not null,
    dust       double precision not null,
    green      double precision not null,
    smoke      double precision not null,
    intensity  double precision not null,
    strength   double precision not null,
    addons     double precision not null
);

alter table rating
    owner to wkknmohztmvnqy;

create unique index rating_id_uindex
    on rating (id);

INSERT INTO public.rating (id, id_comment, general, dust, green, smoke, intensity, strength, addons) VALUES (17, 19, 4, 5, 1, 5, 5, 5, 1);
INSERT INTO public.rating (id, id_comment, general, dust, green, smoke, intensity, strength, addons) VALUES (18, 20, 3, 2, 2, 2, 1, 2, 3);
INSERT INTO public.rating (id, id_comment, general, dust, green, smoke, intensity, strength, addons) VALUES (19, 21, 5, 3, 3, 3, 4, 4, 1);
INSERT INTO public.rating (id, id_comment, general, dust, green, smoke, intensity, strength, addons) VALUES (16, 18, 1, 3, 5, 2, 1, 2, 3);
INSERT INTO public.rating (id, id_comment, general, dust, green, smoke, intensity, strength, addons) VALUES (20, 22, 5, 3, 4, 1, 3, 3, 1);
INSERT INTO public.rating (id, id_comment, general, dust, green, smoke, intensity, strength, addons) VALUES (21, 23, 4, 3, 3, 3, 4, 5, 1);
INSERT INTO public.rating (id, id_comment, general, dust, green, smoke, intensity, strength, addons) VALUES (22, 24, 4, 5, 1, 5, 5, 5, 1);
INSERT INTO public.rating (id, id_comment, general, dust, green, smoke, intensity, strength, addons) VALUES (23, 25, 4, 1, 2, 2, 2, 2, 1);
INSERT INTO public.rating (id, id_comment, general, dust, green, smoke, intensity, strength, addons) VALUES (24, 26, 5, 2, 4, 2, 3, 4, 1);
INSERT INTO public.rating (id, id_comment, general, dust, green, smoke, intensity, strength, addons) VALUES (25, 27, 5, 2, 3, 2, 4, 4, 1);